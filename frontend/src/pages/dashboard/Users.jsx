import { useEffect, useState } from 'react'
import { Plus, Edit, Trash2, Search } from 'lucide-react'
import { CustomAlert, CustomPagination, Dropdown, Modal } from '@/components'
import { closemodal } from '@/components/Modal'
import { toggleAlert } from '@/components/CustomAlert'
import { createUsers, deleteUser, getUsers, updateUsers } from '@/services/dashboard/UserService'
import { handleChangePage } from '@/components/CustomPagination'
import { Skeleton } from '@/components/ui/skeleton'

const roles = ['User', 'Admin']

function Users() {
  const [users, setUsers] = useState([])
  const [page, setPage] = useState(1)
  const [totalPage, setTotalPage] = useState(3)
  const [perPage, setPerPage] = useState("10")
  const [search, setSearch] = useState('')
  const [debouncedSearch, setDebouncedSearch] = useState(search)
  const [errors, setErrors] = useState([])
  const [loading, setLoading] = useState(true)
  const [filterRole, setFilterRole] = useState('')

  const [alert, setAlert] = useState({
    isOpen: false,
    title: '',
    message: '',
    variant: ''
  })

  const [modal, setModal] = useState({
    isOpen: false,
    title: '',
    message: '',
    onConfirm: () => {},
    fields: []
  })

  
  const handleSubmit = async (data, id) => {
    console.log(data);
    
    setLoading(true)
    try {
      let response
      if (id) {
        response = await updateUsers(id, {...data})
      } else {
        response = await createUsers({...data})
      }
      if(response.status === 200) {
        closemodal(setModal)
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      setErrors(err?.response.data.errors)
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoading(false)
    }
  }

  const handleCreate = () => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Create User',
      onConfirm: (data) => handleSubmit(data),
      fields: [
        {
          name: "username",
          placeholder: "Username...",
          required: true,
          label: "Username"
        },
        {
          name: "email",
          placeholder: "Email...",
          required: true,
          label: "Email"
        },
        {
          name: "password",
          placeholder: "Password...",
          required: true,
          label: "Password",
          type: 'password'
        },
        {
          name: "password_confirmation",
          placeholder: "Password Confirmation...",
          required: true,
          label: "Password Confirmation",
          type: 'password'
        },
        {
          name: "role",
          required: true,
          label: "Role",
          type: "select",
          options: [...roles].map(user => ({
            label: user,
            value: user.toLowerCase()
          })),
        },
      ],
      initialValues: { role: 'user' }
    })
  }

  const handleEdit = (user) => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Edit User',
      onConfirm: (data) => handleSubmit(data, user.id),
      fields: [
        {
          name: "username",
          placeholder: "Username...",
          required: true,
          label: "Username"
        },
        {
          name: "email",
          placeholder: "Email...",
          required: true,
          label: "Email"
        },
        {
          name: "role",
          required: true,
          label: "Role",
          type: "select",
          options: [...roles].map(user => ({
            label: user,
            value: user.toLowerCase()
          })),
        },
      ],
      initialValues: { username: user.username, email: user.email, role: user.role}
    })
  }

  const handleChange = (fn, value) => {
    setPage(1)
    setLoading(true)
    fn(value)
  }

  const deleteUserTrigger = (id, name) => {
    setModal({
      onConfirm: () => deleteUserHandle(id),
      isOpen: true, 
      title: 'User delete',
      message: `Are you sure want to delete this user: ${name}?`
    })
  }

  const deleteUserHandle = async (id) => {
    setLoading(true)
    try {
      const response = await deleteUser(id);
      if(response.status === 200) {
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      console.log(err.response);
      
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoading(false)
    } finally {
      closemodal(setModal)
    }
  }

  const fetchData = async () => {
    try {
      const response = await getUsers(page, perPage, search, filterRole)
      const data = response.data?.data
      
      if(response.status === 200) {
        console.log(data.response);
        
        setUsers(data.data)
        setTotalPage(data.last_page)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchData()
  }, [page, debouncedSearch, filterRole, perPage])

  useEffect(() => {
    if(!loading) {
      const timer = setTimeout(() => {
        setLoading(true)
        setDebouncedSearch(search)
        setPage(1)
      }, 1000)
  
      return () => clearTimeout(timer)
    }
  }, [search])

  useEffect(() => {
    if (!alert.isOpen) return

    const timer = setTimeout(() => {
      toggleAlert(setAlert)
    }, 5000)

    return () => clearTimeout(timer)
  }, [alert.isOpen])

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-3xl font-bold text-foreground">Users</h1>
          <p className="text-gray-400 mt-2">Manage application users</p>
        </div>
        <button
          onClick={handleCreate}
          className="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition-colors"
        >
          <Plus size={20} />
          Add User
        </button>
      </div>


      <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-4 backdrop-blur-sm">
          <label className="text-md font-semibold text-slate-300 block mb-3">Seatch by Spot Code</label>
          <Search size={24} className="absolute left-6 top-1/2 transform translate-y-1.5 text-slate-500"  />
          <input
            value={search}
            onChange={e => setSearch(e.target.value)}
            type="text"
            placeholder="Search spot code..."
            className="w-full pl-10 pr-4 py-2.5 rounded-lg bg-slate-800/50 border border-indigo-900/30 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50 transition-all duration-200"
          />
        </div>
        <Dropdown value={filterRole} onChange={handleChange} callback={setFilterRole} name="Role" data={roles}/>
      </div>

      {/* Users Table */}
      <div className="bg-card border border-border rounded-lg overflow-hidden">
        {
          loading ? (
            <table className="w-full">
              <thead className="bg-background border-b border-border">
                <tr>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground"><Skeleton className="h-4 w-20 bg-gray-700" /></th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground"><Skeleton className="h-4 w-20 bg-gray-700" /></th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground"><Skeleton className="h-4 w-20 bg-gray-700" /></th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground"><Skeleton className="h-4 w-20 bg-gray-700" /></th>
                </tr>
              </thead>
              <tbody>
                {[...Array(10)].map((_, i) => (
                  <tr key={i} className="border-b border-border hover:bg-card-hover transition-colors">
                    <td className="px-6 py-4 text-md text-foreground font-medium"><Skeleton className="h-4 w-30 bg-gray-700" /></td>
                    <td className="px-6 py-4 text-md text-gray-400"><Skeleton className="h-4 w-30 bg-gray-700" /></td>
                    <td className="px-6 py-4 text-md">
                      <Skeleton className="h-4 w-30 bg-gray-700" />
                    </td>
                    <td className="px-6 py-4 text-md text-left">
                      <div className="flex items-center justify-start gap-2">
                        <button
                          className="p-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded-lg transition-colors"
                        >
                          <Skeleton className="h-4 w-5 bg-gray-700" />
                        </button>
                        <button
                          className="p-2 bg-blue-500/20 hover:bg-blue-500/30 text-white rounded-lg transition-colors"
                        >
                          <Skeleton className="h-4 w-5 bg-gray-700" />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          ) : (
            <table className="w-full">
              <thead className="bg-background border-b border-border">
                <tr>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground">Userame</th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground">Email</th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground">Role</th>
                  <th className="px-6 py-3 text-left text-md font-semibold text-foreground">Actions</th>
                </tr>
              </thead>
              <tbody>
                {users.map((user) => (
                  <tr key={user.id} className="border-b border-border hover:bg-card-hover transition-colors">
                    <td className="px-6 py-4 text-md text-foreground font-medium">{user.username}</td>
                    <td className="px-6 py-4 text-md text-gray-400">{user.email}</td>
                    <td className="px-6 py-4 text-md">
                      <span className="px-3 py-1 rounded-full text-sm font-semibold bg-blue-500/20 text-blue-400">
                        {user.role}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-md text-left">
                      <div className="flex items-center justify-start gap-2">
                        <button
                          onClick={() => handleEdit(user)}
                          className="p-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded-lg transition-colors"
                        >
                          <Edit size={18} />
                        </button>
                        <button
                          onClick={() => deleteUserTrigger(user.id, user.username)}
                          className="p-2 bg-red-600 hover:bg-red-900 text-white rounded-lg transition-colors"
                        >
                          <Trash2 size={18} />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          )
        }
        {
          users.length === 0 && !loading && (
            <h1 className='text-center font-bold text-3xl translate-y-5'>Parking Spot not found!</h1>
          )
        }
      </div>

      {
        users.length > 0 && !loading && (
          <CustomPagination
            page={page} 
            handleChangePage={
              destinationPage => handleChangePage({
                destinationPage,
                loading: loading,
                page,
                setLoading: setLoading,
                setPage
              })
            } 
            totalPage={totalPage}
            handleChange={handleChange}
            perPage={perPage}
            setPerPage={setPerPage} 
          />
        )
      }

      <Modal
        loading={loading} 
        open={modal.isOpen}
        title={modal.title}
        description={modal.message}
        fields={modal.fields}
        errors={errors}
        onSubmit={modal.onConfirm}
        onCancel={() => closemodal(setModal)}
        initialValues={modal.initialValues}
      />

      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} />
      }
    </div>
  )
}

export default Users