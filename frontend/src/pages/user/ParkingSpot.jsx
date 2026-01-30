import { useState, useEffect } from 'react'
import { Grid, List, Search, AlertCircle } from 'lucide-react'
import { CustomAlert, CustomPagination, Modal } from '@/components'
import { handleChangePage } from '@/components/CustomPagination'
import { useParams } from 'react-router-dom'
import { getParkingSpots } from '@/services/user/ParkingSpot'
import { Skeleton } from '@/components/ui/skeleton'
import { closemodal } from '@/components/Modal'
import { createParkingBook } from '@/services/user/ParkingBook'
import { toggleAlert } from '@/components/CustomAlert'

export default function ParkingSpot() {
  const {id} = useParams()

  const [parkingSpots, setParkingSpots] = useState([])
  const [loading, setLoading] = useState(true)
  const [summary, setSummary] = useState({})
  const [search, setSearch] = useState('')
  const [debouncedSearch, setDebouncedSearch] = useState(search)
  const [totalPage, setTotalPage] = useState(3)
  const [filterStatus, setFilterStatus] = useState('')
  const [page, setPage] = useState(1)
  const [perPage, setPerPage] = useState("10")
  const [viewMode, setViewMode] = useState('grid')
  const [errors, setErrors] = useState({})

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
    setLoading(true)
    try {
      let response
      if(Object.keys(data).includes('start_at') && data['start_at'] !== '') {
        data['start_at'] = toLaravelDatetime(data['start_at'])
      }
      response = await createParkingBook({...data, parking_spot_id: id})
      if(response.status === 200) {
        closemodal(setModal)
        fetchData()
        toggleAlert(setAlert, 'Success', response.data?.message)
      }
    } catch(err) {
      console.log(err?.response.data.message);
      
      setLoading(false)
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
      setErrors(err?.response.data.errors)
    }
  }

  const handleCreate = (id) => {
    setModal({
      isOpen: true,
      message: '',
      title: 'Create Booking',
      onConfirm: (data) => handleSubmit(data, id),
      fields: [
        {
          name: "type",
          label: "Type book",
          required: true,
          type: 'select',
          options: [
            {
              label: 'Walk In',
              value: 'walk_in'
            },
            {
              label: 'Booking',
              value: 'booking'
            }
          ],
        },
        {
          name: "start_at",
          label: "Start Book At",
          type: 'datetime-local',
          required: true,
          showIf: (form) => form.type === "booking",
        },
      ],
      initialValues: {type: 'walk_in'}
    })
  }

  const handleChange = (fn, value) => {
    setPage(1)
    setLoading(true)
    fn(value)
  }

  const getStatusIcon = (status) => {
    switch (status) {
      case 'available': return '✓'
      case 'occupied': return '●'
      case 'reserved': return '⚡'
      case 'broken': return '⚙'
      default: return '○'
    }
  }
  
  const getStatusColor = (status) => {
    switch (status) {
      case 'available': return 'bg-green-100 text-green-800'
      case 'occupied': return 'bg-orange-100 text-orange-800'
      case 'reserved': return 'bg-blue-100 text-blue-800'
      case 'maintenance': return 'bg-slate-100 text-slate-800'
      default: return 'bg-slate-100 text-slate-800'
    }
  }
  const fetchData = async () => {
    try {
      const response = await getParkingSpots({search, perPage, page, filterStatus, id})
      if(response.status === 200) {
        const {summary, parkingSpots} = response.data.data
        
        setParkingSpots(parkingSpots.data)
        setTotalPage(parkingSpots.last_page)
        setSummary(summary)
      }
    } catch(err) {
      console.log(err);
      
      toggleAlert('Error', err?.response.data.message, 'danger')
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
    <div className="min-h-screen ">

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-6 py-8">
        {/* Stats Bar */}
        <div className="grid grid-cols-4 gap-4 mb-8 slide-in-up">
          <div className="bg-white rounded-xl p-4 border border-slate-100">
            <p className="text-xs text-slate-600 mb-1">Total Spots</p>
            <p className="text-2xl font-bold text-slate-900">{summary.total}</p>
          </div>
          <div className="bg-white rounded-xl p-4 border border-slate-100 bg-green-50">
            <p className="text-xs text-green-700 mb-1">Available</p>
            <p className="text-2xl font-bold text-green-600">{summary.available}</p>
          </div>
          <div className="bg-white rounded-xl p-4 border border-slate-100 bg-orange-50">
            <p className="text-xs text-orange-700 mb-1">Occupied</p>
            <p className="text-2xl font-bold text-orange-600">{summary.occupied}</p>
          </div>
          <div className="bg-white rounded-xl p-4 border border-slate-100 bg-blue-50">
            <p className="text-xs text-blue-700 mb-1">Reserved</p>
            <p className="text-2xl font-bold text-blue-600">{summary.reserved}</p>
          </div>
        </div>

        {/* Controls */}
        <div className="bg-white rounded-xl border border-slate-100 p-4 mb-8 slide-in-up" style={{ animationDelay: '0.1s' }}>
          <div className="space-y-4">
            <div className="flex items-center gap-4">
              <div className="flex-1 relative">
                <Search className="absolute left-3 top-3 h-5 w-5 text-slate-400" />
                <input
                  type="text"
                  placeholder="Search spot ID or floor..."
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                  className="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all bg-foreground text-slate-700"
                />
              </div>
              <div className="flex gap-2">
                <button
                  onClick={() => setViewMode('grid')}
                  className={`p-2 rounded-lg transition-colors ${viewMode === 'grid' ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600'}`}
                >
                  <Grid className="h-5 w-5" />
                </button>
                <button
                  onClick={() => setViewMode('list')}
                  className={`p-2 rounded-lg transition-colors ${viewMode === 'list' ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600'}`}
                >
                  <List className="h-5 w-5" />
                </button>
              </div>
            </div>

            <div className="flex gap-2 flex-wrap">
              {[
                {
                  value: '',
                  display: 'all'
                }, 
                {
                  value: 'available',
                  display: 'available'
                }, 
                {
                  value: 'occupied',
                  display: 'occupied'
                }, 
                {
                  value: 'reserved',
                  display: 'reserved'
                }, 
                {
                  value: 'broken',
                  display: 'maintenance'
                }
              ].map((status) => (
                <button
                  key={status}
                  onClick={() => handleChange(setFilterStatus, status.value)}
                  className={`px-3 py-1 rounded-lg text-sm font-medium transition-all capitalize ${
                    filterStatus === status.value
                      ? 'bg-indigo-600 text-white'
                      : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                  }`}
                >
                  {status.display}
                </button>
              ))}
            </div>
          </div>
        </div>

        {/* Grid View */}
        {
          viewMode === 'grid' && (
            <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3 slide-in-up mb-5" style={{ animationDelay: '0.2s' }}>
              {
                !loading ? (
                  <GridComponent handleCreate={handleCreate} parkingSpots={parkingSpots} getStatusIcon={getStatusIcon} />
                ) : (
                  <GridComponent isLoading={loading} />
                )
              }
            </div>
          )
        }

        {/* List View */}
        {viewMode === 'list' && (
          <div className="bg-white rounded-xl border border-slate-100 overflow-hidden slide-in-up mb-5" style={{ animationDelay: '0.2s' }}>
            <table className="w-full">
              <thead className="bg-slate-50 border-b border-slate-200">
                <tr>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-slate-900">Spot Code</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-slate-900">Action</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {
                  !loading ? (
                    <ListComponent handleCreate={handleCreate} parkingSpots={parkingSpots} getStatusColor={getStatusColor} />
                  ) : (
                    <ListComponent isLoading={loading} />
                  )
                }
              </tbody>
            </table>
          </div>
        )}

        {/* Empty State */}
        {parkingSpots.length === 0 && !loading && (
          <div className="text-center py-12">
            <AlertCircle className="h-12 w-12 text-slate-300 mx-auto mb-4" />
            <p className="text-lg font-medium text-slate-900">No parking spots found</p>
            <p className="text-slate-600 mt-1">Try adjusting your search or filters</p>
          </div>
        )}

        {
          parkingSpots.length > 0 && !loading && (
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
              theme='light'
            />
          )
        }
      </main>

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
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} theme='light' />
      }

    </div>
  )
}

const GridComponent = ({handleCreate = () => {}, parkingSpots = [...Array(12)], getStatusIcon = () => {}, isLoading}) => {
  return (
    parkingSpots.map((spot, i) => (
      <button
        onClick={() => handleCreate(spot.id)}
        key={i}
        disabled={isLoading ? true : spot.status !== 'available'}
        className={`p-4 rounded-xl border-2 transition-all font-semibold text-center ${
          isLoading ? 'border-slate-300 bg-slate-100 text-slate-500 cursor-not-allowed' : spot.status === 'available'
            ? 'border-green-300 bg-green-50 text-green-700 hover:border-green-500 hover:shadow-md cursor-pointer'
            : spot.status === 'occupied'
              ? 'border-orange-300 bg-orange-50 text-orange-700 cursor-not-allowed'
              : spot.status === 'reserved'
                ? 'border-blue-300 bg-blue-50 text-blue-700 cursor-not-allowed'
                : 'border-slate-300 bg-slate-100 text-slate-500 cursor-not-allowed'
        }`}
      >
        <div className="text-lg">{isLoading ? <Skeleton className="h-4 w-6 bg-gray-400 mb-3 justify-self-center" /> : getStatusIcon(spot.status)}</div>
        <div className="text-md">{isLoading ? <Skeleton className="h-4 w-14 bg-gray-400 mb-3 justify-self-center" /> : spot.spot_number}</div>
        <div className="text-sm opacity-75">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400 justify-self-center" /> : spot.status}</div>
      </button>
    ))
  )
}

const ListComponent = ({handleCreate = () => {}, parkingSpots = [...Array(10)], getStatusColor = () => {}, isLoading}) => {
  return (
    parkingSpots.map((spot, i) => (
      <tr key={i} className="hover:bg-slate-50 transition-colors">
        <td className="px-6 py-4 text-sm font-semibold text-slate-900">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400 mb-3" /> : spot.spot_number}</td>
        <td className="px-6 py-4 text-sm">
          {
            isLoading ? <Skeleton className="h-4 w-14 bg-gray-400 mb-3" /> : (
              <span className={`px-3 py-1 rounded-lg text-xs font-semibold capitalize ${isLoading ? 'bg-slate-100 text-slate-800' : getStatusColor(spot.status)}`}>
                {spot.status}
              </span>
            )
          }
        </td>
        <td className="px-6 py-4 text-sm">
          {isLoading ? <Skeleton className="h-4 w-10 bg-gray-400 mb-3" /> : spot.status === 'available' ? (
            <button 
              onClick={() => handleCreate(spot.id)}
              className="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium" 
            >
              Book
            </button>
          ) : (
            <span className="text-slate-500">-</span>
          )}
        </td>
      </tr>
    ))
  )
}

function toLaravelDatetime(datetimeLocal) {
  const date = new Date(datetimeLocal);

  const pad = (n) => n.toString().padStart(2, '0');

  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())} `
       + `${pad(date.getHours())}:${pad(date.getMinutes())}:00`;
}
