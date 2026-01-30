import { useEffect, useState } from 'react'
import { Mail, Shield, Edit2, Calendar} from 'lucide-react'
import { me, updateUser } from '@/services/dashboard/UserService'
import { CustomAlert, Modal } from '@/components'
import { toggleAlert } from '@/components/CustomAlert'
import { closemodal } from '@/components/Modal'
import { Skeleton } from '@/components/ui/skeleton'

const roles = ['User', 'Admin']

function Profile() {
  const [profile, setProfile] = useState({})

  const [loading, setLoading] = useState(true)
  const [errors, setErrors] = useState({})

  const [modal, setModal] = useState({
    isOpen: false,
    title: '',
    message: '',
    onConfirm: () => {},
    fields: []
  })

  const [alert, setAlert] = useState({
    isOpen: false,
    title: '',
    message: '',
    variant: ''
  })

  const handleSubmit = async (data, id) => {
    console.log(data);
    
    setLoading(true)
    try {
      const response = await updateUser({...data})
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

  const handleEdit = (user) => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Edit Profile',
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
          name: "role",
          required: true,
          label: "Role",
          type: "select",
          options: [...roles].map(user => ({
            label: user,
            value: user.toLowerCase()
          })),
        },
        {
          name: "password",
          placeholder: "Password...",
          label: "Password",
          type: 'password'
        },
        {
          name: "password_confirmation",
          placeholder: "Password...",
          label: "Password Confirmation",
          type: 'password'
        },
      ],
      initialValues: { username: user.username, email: user.email, role: user.role}
    })
  }

  const fetchData = async () => {
    try {
      const response = await me()
      if(response.status === 200) {
        const data = response.data?.data
        data['created_at'] = new Date(data['created_at']).toDateString()
        setProfile(data)
      } 
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchData()
  }, [])
  
  useEffect(() => {
    if (!alert.isOpen) return

    const timer = setTimeout(() => {
      toggleAlert(setAlert)
    }, 5000)

    return () => clearTimeout(timer)
  }, [alert.isOpen])

  return (
    <div className="space-y-8">
    {/* Header */}
    <div className="flex items-center justify-between">
      <div>
        <h1 className="text-4xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent">Admin Profile</h1>
        <p className="text-slate-400 mt-2">Manage your profile and account settings</p>
      </div>
      <button
        onClick={() => handleEdit(profile)}
        className="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2.5 rounded-lg transition-all duration-200 shadow-lg shadow-indigo-500/30 font-medium"
      >
        <Edit2 size={20} />
        Edit Profile
      </button>
    </div>

    {/* Main Profile Card */}
    <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-8 backdrop-blur-sm">
      {/* Avatar & Info Section */}
      <div className="flex flex-col md:flex-row items-start gap-8 pb-8 border-b border-indigo-900/20">
        <div className="flex items-center gap-8">
          <div className="w-32 h-32 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white text-5xl font-bold shadow-lg shadow-indigo-500/40">
            {loading ? <Skeleton className="h-10 w-10 bg-gray-500" /> : profile.username?.charAt(0)}
          </div>
          <div>
            <h2 className="text-3xl font-bold text-slate-100 mb-3">{loading ? <Skeleton className="h-5 w-20 bg-gray-700" /> : profile?.username}</h2>
            <div className="flex items-center gap-2 text-indigo-300 mb-3">
              {!loading && <Shield size={18} />}
              <span className="font-semibold text-lg">{loading ? <Skeleton className="h-4 w-20 bg-gray-700" /> : profile?.role}</span>
            </div>
            <div className="flex items-center gap-2 text-slate-400">
              {!loading && <Calendar size={16} />}
              <span className="text-sm">{loading ? <Skeleton className="h-4 w-40 bg-gray-700" /> : `Member since ${profile.created_at}`}</span>
            </div>
          </div>
        </div>
      </div>

      {/* Profile Information */}
        <div className="space-y-6 mt-8">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {/* Email */}
            <div>
              <div className="flex items-center gap-2 mb-3">
                {!loading && <Mail size={18} className="text-indigo-400" />}
                <label className="text-sm font-semibold text-slate-300">{loading ? <Skeleton className="h-4 w-40 bg-gray-700" /> : 'Email Address'}</label>
              </div>
              <div className="text-slate-300 font-medium pl-6">{loading ? <Skeleton className="h-4 w-40 bg-gray-700" /> : profile.email}</div>
            </div>
          </div>
        </div>
    </div>

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

export default Profile
