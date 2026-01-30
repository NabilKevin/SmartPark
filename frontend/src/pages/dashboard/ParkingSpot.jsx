import { useEffect, useState } from 'react'
import { Plus, Edit, Unlock, Lock, Search } from 'lucide-react'
import { CustomPagination, Dropdown, Modal, StatCard } from '@/components'
import { activateParkingSpot, createParkingSpots, deactivateParkingSpot, getParkingLots, getParkingSpots, updateParkingSpots } from '@/services/dashboard/ParkingSpotService'
import { Skeleton } from '@/components/ui/skeleton'
import { closemodal } from '@/components/Modal'
import CustomAlert, { toggleAlert } from '@/components/CustomAlert'
import { handleChangePage } from '@/components/CustomPagination'

const statusData = ['Available', 'Occupied', 'Reserved', 'Broken', 'Inactive']

function ParkingSpots() {
  const [spots, setSpots] = useState([])
  const [summary, setSummary] = useState({})
  const [page, setPage] = useState(1)
  const [totalPage, setTotalPage] = useState(3)
  const [perPage, setPerPage] = useState("10")
  const [search, setSearch] = useState('')
  const [debouncedSearch, setDebouncedSearch] = useState(search)
  const [errors, setErrors] = useState([])
  const [loadingData, setLoadingData] = useState(true)
  const [loadingStats, setLoadingStats] = useState(true)
  const [parkingLots, setParkingLots] = useState([])

  const [filterLotId, setFilterLotId] = useState('')
  const [filterStatus, setFilterStatus] = useState('')

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
    setLoadingData(true)
    try {
      let response
      if (id) {
        response = await updateParkingSpots(id, {...data})
      } else {
        response = await createParkingSpots({...data})
      }
      if(response.status === 200) {
        closemodal(setModal)
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoadingData(false)
      setErrors(err?.response.data.errors)
    }
  }

  const handleCreate = () => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Create Parking Spot',
      onConfirm: (data) => handleSubmit(data),
      fields: [
        {
          name: "create_type",
          required: true,
          label: "Create Type",
          type: 'select',
          options: [
            {
              label: 'Bulk generate',
              value: 'bulk_generate'
            },
            {
              label: 'Custom Number',
              value: 'custom_number'
            }
          ],
        },
        {
          name: "parking_lot_id",
          required: true,
          label: "Parking Lot",
          type: 'select',
          options: [...parkingLots].map(lot => ({
            label: lot.name,
            value: lot.id
          })),
        },
        {
          name: "start_number",
          label: "Start Number",
          placeholder: "Start Number...",
          required: true,
          showIf: (form) => form.create_type === "bulk_generate",
        },
        {
          name: "amount",
          label: "Amount",
          placeholder: "Amount...",
          required: true,
          showIf: (form) => form.create_type === "bulk_generate",
        },
        {
          name: "custom_number",
          label: "Custom Number (separate by comma)",
          placeholder: "Numbers...",
          required: true,
          showIf: (form) => form.create_type === "custom_number",
        },
      ],
      initialValues: { create_type: 'bulk_generate' }
    })
  }

  const handleEdit = (spot) => {
    console.log(spot);
    
    setModal({
      isOpen: true,
      message: '',
      title: 'Edit Parking Spot',
      onConfirm: (data) => handleSubmit(data, spot.id),
      fields: [
        {
          name: "spot_number",
          placeholder: "Spot Number...",
          required: true,
          label: "Spot Number"
        },
        {
          name: "status",
          label: "Status",
          placeholder: "Status...",
          required: true,
          type: 'select',
          options: [...statusData].map(status => ({
            label: status,
            value: status.toLowerCase()
          })),
        },
      ],
      initialValues: { spot_number: spot.spot_number, status: spot.status}
    })
  }

  const handleChange = (fn, value) => {
    setPage(1)
    setLoadingData(true)
    setLoadingStats(true)
    fn(value)
  }

  const activateSpotTrigger = (id, name) => {
    setModal({
      onConfirm: () => activateSpot(id),
      isOpen: true, 
      title: 'Parking spot activation',
      message: `Are you sure want to activate this spot: ${name}?`
    })
  }
  const deactivateSpotTrigger = (id, name) => {
    setModal({
      onConfirm: (data) => deactivateSpot(id, data),
      isOpen: true, 
      title: 'Parking spot deactivation',
      message: `Are you sure want to deactivate this spot: ${name}?`,
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

  const activateSpot = async (id) => {
    setLoadingData(true)
    try {
      const response = await activateParkingSpot(id);
      if(response.status === 200) {
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoadingData(false)
    } finally {
      closemodal(setModal)
    }
  }

  const deactivateSpot = async (id, data) => {
    setLoadingData(true)
    try {
      const response = await deactivateParkingSpot(id, data);
      console.log('s');
      
      if(response.status === 200) {
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
        closemodal(setModal)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setLoadingData(false)
      setErrors(err?.response.data.errors)
    }
  }

  const fetchParkingLots = async () => {
    try {
      const response = await getParkingLots()
      const data = response.data?.data
      if(response.status === 200) {
        setParkingLots(data)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    }
  }

  const fetchData = async () => {
    try {
      const response = await getParkingSpots(page, perPage, search, filterLotId, filterStatus)
      const data = response.data?.data.data
      const summary = response.data?.data.summary
      
      if(response.status === 200) {
        setSpots(data.data)
        setTotalPage(data.last_page)
        setSummary({
          'totalSpot': data.total,
          'totalAvailable': summary.available,
          'totalOccupied': summary.occupied,
        })
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoadingData(false)
      setLoadingStats(false)
    }
  }

  useEffect(() => {
    fetchParkingLots()
  }, [])

  useEffect(() => {
    fetchData()
  }, [page, debouncedSearch, filterLotId, filterStatus, perPage])

  useEffect(() => {
    if(!loadingData && !loadingStats) {
      const timer = setTimeout(() => {
        setLoadingData(true)
        setLoadingStats(true)
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
          <h1 className="text-4xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent">Parking Spots</h1>
          <p className="text-slate-400 mt-2">Manage individual parking spots across all lots</p>
        </div>
        <button
          onClick={() => handleCreate()}
          className="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2.5 rounded-lg transition-all duration-200 shadow-lg shadow-indigo-500/30 font-medium"
        >
          <Plus size={20} />
          Add Spot
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-5">
        <StatCard
          label="Total Spots"
          value={loadingStats ? <Skeleton className="h-4 w-12 bg-gray-700" /> : summary?.totalSpot}
        />
        <StatCard
          label="Available"
          value={loadingStats ? <Skeleton className="h-4 w-12 bg-gray-700" /> : summary?.totalAvailable}
        />
        <StatCard
          label="Occupied"
          value={loadingStats ? <Skeleton className="h-4 w-12 bg-gray-700" /> : summary?.totalOccupied}
        />
      </div>

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

      <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
        <Dropdown value={filterLotId} onChange={handleChange} callback={setFilterLotId} name="Parking Lot" data={parkingLots}/>
        <Dropdown value={filterStatus} onChange={handleChange} callback={setFilterStatus} name="Status" data={statusData}/>
      </div>

      {/* Spots List */}
      <div className="space-y-3">
        {
          loadingData ? (
            [...Array(10)].map((_, i) => (
              <div key={i} className="bg-gradient-to-br to-slate-900/50 border rounded-xl p-4 transition-all duration-200 backdrop-blur-sm flex items-center justify-between from-slate-800/50 border-emerald-900/30 hover:border-emerald-900/60">
                <div className="flex items-center gap-4 flex-1">
                  <div className="w-12 h-12 rounded-lg flex items-center justify-center font-bold text-lg bg-gray-600/20 text-emerald-400">
                    <Skeleton className="h-4 w-5 bg-gray-700" />
                  </div>
                  <div>
                    <div className="font-semibold text-slate-100"><Skeleton className="h-4 w-40 bg-gray-700" /></div>
                    <div className="text-md font-medium capitalize mt-2">
                      <Skeleton className="h-4 w-20 bg-gray-700" />
                    </div>
                  </div>
                </div>
    
                <div className="flex gap-2">
                  <div className="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg bg-gray-600/20 text-emerald-400">
                    <Skeleton className="h-4 w-5 bg-gray-700" />
                  </div>
                  <div className="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg bg-gray-600/20 text-emerald-400">
                    <Skeleton className="h-4 w-5 bg-gray-700" />
                  </div>
                </div>
              </div>
            ))
          ) : (
              spots?.map((spot, i) => (
                <div key={spot.id} className={`bg-gradient-to-br to-slate-900/50 border rounded-xl p-4 transition-all duration-200 backdrop-blur-sm flex items-center justify-between ${
                  spot.status === 'available'
                    ? 'from-slate-800/50 border-emerald-900/30 hover:border-emerald-900/60'
                    : 'from-slate-800/30 border-red-900/30 hover:border-red-900/60'
                }`}>
                  <div className="flex items-center gap-4 flex-1">
                    <div className={`w-12 h-12 rounded-lg flex items-center justify-center font-bold text-lg ${
                      spot.status === 'available'
                        ? 'bg-emerald-600/20 text-emerald-400'
                        : 'bg-red-600/20 text-red-400'
                    }`}>
                      {(i+1) + (perPage * (page-1))}
                    </div>
                    <div>
                      <p className="font-semibold text-slate-100">{`${spot.spot_number} - ${spot.parking_lot?.name}`}</p>
                      <p className={`text-md font-medium capitalize ${spot.status === 'available' ? 'text-emerald-400' : 'text-red-400'}`}>
                        {`${spot.status === 'available' ? '✓' : '✗'} ${spot.status} ${spot.status === 'inactive' ? `- ${spot.deactivated_reason}` : ''}`}
                      </p>
                    </div>
                  </div>
      
                  <div className="flex gap-2">
                    <button
                      className={`p-2 rounded-lg transition-all duration-200 border ${
                        spot.status !== 'inactive'
                          ? 'bg-red-600/20 hover:bg-red-600/30 text-red-400 border-red-600/30'
                          : 'bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border-emerald-600/30'
                      }`}
                      onClick={
                        spot.status === 'inactive' ? () => activateSpotTrigger(spot.id, spot.spot_number) : () => deactivateSpotTrigger(spot.id, spot.spot_number)
                      }
                    >
                      {spot.status === 'inactive' ? <Unlock size={18} /> : <Lock size={18} />}
                    </button>
                    {
                      spot.status !== 'inactive' && (
                        <button
                          onClick={() => handleEdit(spot)}
                          className="p-2 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 rounded-lg transition-all duration-200 border border-blue-600/30"
                        >
                          <Edit size={18} />
                        </button>
                      )
                    }
                  </div>
                </div>
              ))
          ) 
        }
        {
          spots.length === 0 && !loadingData && (
            <h1 className='text-center font-bold text-3xl translate-y-5'>Parking Spot not found!</h1>
          )
        }
      </div>
      {
        spots.length > 0 && !loadingData && (
          <CustomPagination 
            page={page} 
            handleChangePage={
              destinationPage => handleChangePage({
                destinationPage,
                loading: loadingData,
                page,
                setLoading: setLoadingData,
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
        loading={loadingData} 
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

export default ParkingSpots
