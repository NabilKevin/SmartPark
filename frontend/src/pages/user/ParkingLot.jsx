import { useState, useEffect } from 'react'
import { Search, AlertCircle } from 'lucide-react'
import { CardParkingLot, CustomAlert } from '@/components'
import { getParkingLots } from '@/services/user/ParkingLot'
import CustomPagination, { handleChangePage } from '@/components/CustomPagination'
import { toggleAlert } from '@/components/CustomAlert'

export default function ParkingLot() {
  const [parkingLots, setParkingLots] = useState([])
  const [loading, setLoading] = useState(true)
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

  const handleChange = (fn, value) => {
    setPage(1)
    setLoading(true)
    fn(value)
  }

  const fetchData = async () => {
    try {
      const response = await getParkingLots({search, perPage, page, filterStatus})
      if(response.status === 200) {
        const paginate = response.data.data
        setParkingLots(paginate.data)
        setTotalPage(paginate.last_page)
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
    <div className="min-h-screen bg-gradient-to-br from-white via-slate-50 to-blue-50">

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-6 py-8">
        {/* Title Section */}
        <div className="mb-8 slide-in-up">
          <h2 className="text-3xl font-bold text-slate-900 mb-2">Browse Parking Lots</h2>
          <p className="text-slate-600">Find and book parking at your preferred location</p>
        </div>

        {/* Search and Filter */}
        <div className="mb-8 slide-in-up" style={{ animationDelay: '0.1s' }}>
          <div className="space-y-4">
            <div className="relative">
              <Search className="absolute left-4 top-4 h-5 w-5 text-slate-400" />
              <input
                type="text"
                placeholder="Search by location or parking lot name..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                className="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700"
              />
            </div>

            <div className="flex gap-2 flex-wrap">
              {['', 'available', 'full'].map((status) => (
                <button
                  key={status}
                  onClick={() => handleChange(setFilterStatus, status)}
                  className={`px-4 py-2 rounded-lg font-medium transition-all ${
                    filterStatus === status
                      ? 'bg-indigo-600 text-white'
                      : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                  }`}
                >
                  {status === '' ? 'All Lots' : status === 'full' ? 'Full' : 'With Spaces'}
                </button>
              ))}
            </div>
          </div>
        </div>

        {/* Parking Lots Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {!loading && parkingLots.map((lot, i) => (
            <CardParkingLot lot={lot} key={i}/>
          ))}
          {
            loading && (
              [...Array(6)].map((_, i) => (
                <CardParkingLot key={i} isLoading={true} />
              ))
            )
          }
        </div>

        {/* Empty State */}
        {parkingLots.length === 0 && !loading && (
          <div className="text-center py-12">
            <AlertCircle className="h-12 w-12 text-slate-300 mx-auto mb-4" />
            <p className="text-lg font-medium text-slate-900">No parking lots found</p>
            <p className="text-slate-600 mt-1">Try adjusting your search or filters</p>
          </div>
        )}

        {
          parkingLots.length > 0 && !loading && (
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
        {
          alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} theme='light' />
        }
      </main>

    </div>
  )
}
