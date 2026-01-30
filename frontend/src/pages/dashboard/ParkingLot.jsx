import { useEffect, useMemo, useState } from 'react'
import { Plus, Edit, Lock, Unlock, Search } from 'lucide-react'
import { StatCard } from '@/components/dashboard'
import { activateParkingLot, createParkingLots, deactivateParkingLot, getParkingLots, updateParkingLots } from '@/services/dashboard/ParkingLotService'
import { Skeleton } from '@/components/ui/skeleton'
import { CustomAlert, CustomPagination, Dropdown, Modal } from '@/components'
import { closemodal } from '@/components/Modal'
import { toggleAlert } from '@/components/CustomAlert'
import { handleChangePage } from '@/components/CustomPagination'

const statusData = ['Active', 'Inactive']

function ParkingLots() {
  const [lots, setLots] = useState([])
  const [summary, setSummary] = useState({})

  const [modal, setModal] = useState({
    isOpen: false,
    title: '',
    message: '',
    onConfirm: () => {},
    fields: []
  })
  const [errors, setErrors] = useState({})
  const [search, setSearch] = useState('')
  const [debouncedSearch, setDebouncedSearch] = useState(search)
  const [totalPage, setTotalPage] = useState(3)
  const [filterStatus, setFilterStatus] = useState('')
  const [page, setPage] = useState(1)
  const [perPage, setPerPage] = useState("10")
  const [alert, setAlert] = useState({
    isOpen: false,
    title: '',
    message: '',
    variant: ''
  })
  const [loading, setLoading] = useState(true)

  const handleChange = (fn, value) => {
    setPage(1)
    setLoading(true)
    fn(value)
  }

  const handleSubmit = async (data, id) => {
    setLoading(true)
    try {
      let response
      if (id) {
        response = await updateParkingLots(id, {...data})
      } else {
        response = await createParkingLots({...data})
      }
      if(response.status === 200) {
        closemodal(setModal)
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      
      setLoading(false)
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setErrors(err?.response.data.errors)
    }
  }

  const handleCreate = () => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Create Parking Lot',
      onConfirm: (data) => handleSubmit(data),
      fields: [
        {
          name: "name",
          label: "Name",
          placeholder: "Name...",
          required: true,
        },
        {
          name: "prefix",
          label: "Prefix",
          placeholder: "Prefix...",
          required: true,
        },
        {
          name: "capacity",
          label: "Capacity",
          placeholder: "Capacity...",
          required: true,
          type: 'integer',
          min: 1
        },
      ],
    })
  }

  const handleEdit = (lot) => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Edit Parking Lot',
      onConfirm: (data) => handleSubmit(data, lot.id),
      fields: [
        {
          name: "name",
          label: "Name",
          label: "name",
          placeholder: "Name...",
          required: true,
        },
        {
          name: "prefix",
          label: "Prefix",
          placeholder: "Prefix...",
          required: true,
        },
        {
          name: "capacity",
          label: "Capacity",
          placeholder: "Capacity...",
          required: true,
          type: 'integer',
          min: 1
        },
      ],
      initialValues: { name: lot.name, prefix: lot.prefix, capacity: lot.capacity}
    })
  }

  const activateLotTrigger = (id, name) => {
    setModal({
      onConfirm: () => activateLot(id),
      isOpen: true, 
      title: 'Parking lot activation',
      message: `Are you sure want to activate this lot: ${name}?`
    })
  }
  const deactivateLotTrigger = (id, name) => {
    setModal({
      onConfirm: (data) => deactivateLot(id, data),
      isOpen: true, 
      title: 'Parking lot deactivation',
      message: `Are you sure want to deactivate this lot: ${name}?`,
      fields: [
        {
          name: "deactivated_reason",
          label: "Deactivated Reason",
          placeholder: "Deactivated reason...",
          required: true,
        }
      ]
    })
  }

  const activateLot = async (id) => {
    setLoading(true)
    try {
      const response = await activateParkingLot(id);
      if(response.status === 200) {
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoading(false)
    } finally {
      closemodal(setModal)
    }
  }

  const deactivateLot = async (id, data) => {
    setLoading(true)
    try {
      const response = await deactivateParkingLot(id, data);
      if(response.status === 200) {
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
        closemodal(setModal)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoading(false)
      setErrors(err?.response.data.errors)
    }
  }

  const fetchData = async () => {
    try {
      const response = await getParkingLots(page, perPage, search, filterStatus);
      if(response.status === 200) {
        const {parkingLots, ...summary} = response.data?.data
        setLots(parkingLots.data)
        setSummary(summary)
        setTotalPage(parkingLots.last_page)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchData()
  }, [page, debouncedSearch, filterStatus, perPage])

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
    <div className="space-y-8">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-4xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent">Parking Lots</h1>
          <p className="text-slate-400 mt-2">Manage all parking lots in the system</p>
        </div>
        <button
          onClick={() => handleCreate()}
          className="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2.5 rounded-lg transition-all duration-200 shadow-lg shadow-indigo-500/30 font-medium"
        >
          <Plus size={20} />
          Add Parking Lot
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <StatCard
          loading={loading}
          label="Total Lots"
          value={summary?.totalActiveLots}
        />
        <StatCard
          loading={loading}
          label="Total Capacity"
          value={summary?.totalActiveCapacity}
        />
        <StatCard
          loading={loading}
          label="Available Spaces"
          value={summary?.totalAvailableSpots}
        />
        <StatCard
          loading={loading}
          label="Occupancy Rate"
          value={summary?.occupancyRate || summary.occupancyRate === 0 ? `${summary.occupancyRate}%` : null}
        />
      </div>

      {/* Additional Stats */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
        <StatCard
          loading={loading}
          label="Lots with Available Spaces"
          value={summary?.activeLotWithAvailableSpace}
        />
        <StatCard
          loading={loading}
          label="Fully Occupied Lots"
          value={summary?.activeLotWithFullyOccupied}
        />
      </div>


      <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-4 backdrop-blur-sm">
          <label className="text-md font-semibold text-slate-300 block mb-3">Search by Name</label>
          <Search size={24} className="absolute left-6 top-1/2 transform translate-y-1.5 text-slate-500"  />
          <input
            value={search}
            onChange={e => setSearch(e.target.value)}
            type="text"
            placeholder="Search name..."
            className="w-full pl-10 pr-4 py-2.5 rounded-lg bg-slate-800/50 border border-indigo-900/30 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50 transition-all duration-200"
          />
        </div>
        <Dropdown value={filterStatus} onChange={handleChange} callback={setFilterStatus} name="Status" data={statusData}/>
      </div>

      {/* Parking Lots List */}
      <div className="space-y-4">
        {loading ? (
          [...Array(3)].map((_, k) => {
            return (
              <DataCard k={k}/>
            )
          })
        ) : (
          lots.map((lot, id) => {
            const occupancyColor = lot.occupancy > 80 ? 'text-red-400' : lot.occupancy > 50 ? 'text-yellow-400' : 'text-green-400'
            return (
              <DataCard loading={loading} id={id} lot={lot} occupancyColor={occupancyColor} deactivateLotTrigger={deactivateLotTrigger} activateLotTrigger={activateLotTrigger} handleEdit={handleEdit} />
            )
          })
        )}
        {
          lots.length === 0 && !loading && (
            <h1 className='text-center font-bold text-3xl translate-y-5'>Parking Spot not found!</h1>
          )
        }
      </div>

      {
        lots.length > 0 && !loading && (
          <CustomPagination
            page={page} 
            handleChangePage={
              destinationPage => handleChangePage({
                destinationPage,
                loading,
                page,
                setLoading,
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

const DataCard = ({lot = {}, occupancyColor = 'text-green-400', deactivateLotTrigger, activateLotTrigger, handleEdit, id, loading}) => {
  return (
    <div key={id} className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-6 hover:border-indigo-900/60 transition-all duration-200 backdrop-blur-sm">
      <div className="flex items-start justify-between">
        <div className="flex-1">
          <h3 className="text-lg font-bold text-slate-100 mb-2">{lot.name ?? <Skeleton className="h-4 w-20 bg-gray-700" />}</h3>
          
          <div className={`grid ${lot.status === 'inactive' ? 'grid-cols-3' : 'grid-cols-5'} gap-4`}>
            <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
              <div className="text-slate-400 text-md font-medium mb-1">{lot.prefix || lot.prefix === 0 ? 'Code' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
              <div className="text-indigo-300 font-semibold text-lg space-y-4">{lot.prefix ?? <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
            </div>
            <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
              <div className="text-slate-400 text-md font-medium mb-1">{lot.capacity || lot.capacity === 0 ? 'Total Capacity' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
              <div className="text-indigo-300 font-semibold text-lg space-y-4">{lot.capacity ?? <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
            </div>
            <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
              <div className="text-slate-400 text-md font-medium mb-1">{lot.available_spots || lot.available_spots === 0 ? 'Available' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
              <div className="text-green-400 font-semibold text-lg">{lot.available_spots ?? <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
            </div>
            <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
              <div className="text-slate-400 text-md font-medium mb-1">{lot.occupancy || lot.occupancy === 0 ? 'Occupancy' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
              <div className={`${occupancyColor} font-semibold text-lg`}>{lot.occupancy ?? <Skeleton className="h-4 w-20 bg-gray-700" />}{lot.occupancy || lot.occupancy === 0 ? '%' : ''}</div>
            </div>
            <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
              <div className="text-slate-400 text-md font-medium mb-1">{lot.status ? 'Status' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
              <div className={`${lot.status === 'active' ? 'text-green-400' : 'text-red-400'} font-semibold text-lg`}>{lot.status ?? <Skeleton className="h-4 w-20 bg-gray-700"/>}</div>
            </div>
            {
              lot.status === 'inactive' && (
                <div className="bg-slate-800/50 rounded-lg p-3 border border-indigo-900/20">
                  <div className="text-slate-400 text-md font-medium mb-1">{lot.deactivated_reason ? 'Deactivated reason' : <Skeleton className="h-4 w-20 bg-gray-700" />}</div>
                  <div className="text-red-400 font-semibold text-lg">{lot.deactivated_reason ?? <Skeleton className="h-4 w-20 bg-gray-700"/>}</div>
                </div>
              )
            }
          </div>
        </div>

        {/* Action Buttons */}
        <div className="flex gap-2 ml-4">
          {
            loading ? (
              <div className="flex gap-2">
                <div className="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg bg-gray-600/20 text-emerald-400">
                  <Skeleton className="h-4 w-5 bg-gray-700" />
                </div>
                <div className="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg bg-gray-600/20 text-emerald-400">
                  <Skeleton className="h-4 w-5 bg-gray-700" />
                </div>
              </div>
            ) : (
              lot.status === 'active' ? (
                <button
                  onClick={() => deactivateLotTrigger(lot.id, lot.name)}
                  className="p-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg transition-all duration-200 border border-red-600/30"
                >
                  <Lock size={18} />
                </button>
              ) : (
                <button
                  onClick={() => activateLotTrigger(lot.id, lot.name)}
                  className="p-2 bg-green-600/20 hover:bg-green-600/30 text-green-400 rounded-lg transition-all duration-200 border border-green-600/30"
                >
                  <Unlock size={18} />
                </button>
              )
            )
          }
          {
            lot.status === 'active' && (
              <button
                onClick={() => handleEdit(lot)}
                className="p-2 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 rounded-lg transition-all duration-200 border border-blue-600/30"
              >
                <Edit size={18} />
              </button>
            )
          }
        </div>
      </div>
    </div>
  )
}

export default ParkingLots
