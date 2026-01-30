import React, { useState, useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import { LogOut, Search, Download, Calendar, Clock, DollarSign, MapPin, AlertCircle } from 'lucide-react'
import { checkout, getParkingHistories } from '@/services/user/ParkingBook'
import CustomPagination, { handleChangePage } from '@/components/CustomPagination'
import { Skeleton } from '@/components/ui/skeleton'
import { CustomAlert, Modal } from '@/components'
import { closemodal } from '@/components/Modal'
import { toggleAlert } from '@/components/CustomAlert'

export default function ParkingHistory() {
  const [parkingHistory, setParkingHistory] = useState([])
  const [loading, setLoading] = useState(true)
  const [search, setSearch] = useState('')
  const [debouncedSearch, setDebouncedSearch] = useState(search)
  const [totalPage, setTotalPage] = useState(3)
  const [filterDate, setFilterDate] = useState('')
  const [page, setPage] = useState(1)
  const [perPage, setPerPage] = useState("10")

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

  const handleChange = (fn, value) => {
    setPage(1)
    setLoading(true)
    fn(value)
  }

  const getStatusColor = (status) => {
    switch (status) {
      case 'completed': return 'bg-green-100 text-green-800'
      case 'active': return 'bg-orange-100 text-orange-800'
      case 'booked': return 'bg-blue-100 text-blue-800'
      case 'expired': return 'bg-red-100 text-red-800'
      default: return 'bg-red-100 text-red-800'
    }
  }

  const handleCheckout = async (id) => {
    setLoading(true)
    try {
      const response = await checkout(id)
      if(response.status === 200) {
        toggleAlert(setAlert, 'Success', response.data.message, '')
        closemodal(setModal)
        fetchData()
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    }
  } 

  const handleTriggerCheckout = (id) => {
    setModal({
      isOpen: true,
      message: 'Are you sure want to checkout?',
      title: 'Book checkout!',
      onConfirm: (data) => handleCheckout(id),
    })
  }
  const fetchData = async () => {
    try {
      const response = await getParkingHistories({search, perPage, page, filterDate})
      if(response.status === 200) {
        const paginate = response.data.data
        
        setParkingHistory(paginate.data)
        setTotalPage(paginate.meta.last_page)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoading(false)
    }
  } 

  useEffect(() => {
    fetchData()
  }, [page, debouncedSearch, filterDate, perPage])

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
          <h2 className="text-3xl font-bold text-slate-900 mb-2">Your Parking History</h2>
          <p className="text-slate-600">View all your parking sessions and spending</p>
        </div>

        {/* Stats Cards */}
        {/* <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 slide-in-up" style={{ animationDelay: '0.1s' }}>
          <div className="bg-white rounded-2xl border border-slate-100 p-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm text-slate-600 mb-1">Total Sessions</p>
                <p className="text-3xl font-bold text-slate-900">{completedSessions}</p>
              </div>
              <Clock className="h-10 w-10 text-indigo-200" />
            </div>
          </div>

          <div className="bg-white rounded-2xl border border-slate-100 p-6 bg-blue-50">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm text-blue-700 mb-1">Avg Duration</p>
                <p className="text-3xl font-bold text-blue-600">4h 30m</p>
              </div>
              <Clock className="h-10 w-10 text-blue-200" />
            </div>
          </div>

          <div className="bg-white rounded-2xl border border-slate-100 p-6 bg-orange-50">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm text-orange-700 mb-1">Ongoing</p>
                <p className="text-3xl font-bold text-orange-600">{ongoingSessions}</p>
              </div>
              <MapPin className="h-10 w-10 text-orange-200" />
            </div>
          </div>
        </div> */}

        {/* Search and Filter */}
        <div className="bg-white rounded-xl border border-slate-100 p-4 mb-8 slide-in-up" style={{ animationDelay: '0.2s' }}>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="relative">
              <Search className="absolute left-3 top-3 h-5 w-5 text-slate-700" />
              <input
                type="text"
                placeholder="Search by spot ID or parking lot..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
                className="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all bg-foreground text-slate-700"
              />
            </div>

            <div className="relative">
              <Calendar className="absolute left-3 top-3 h-5 w-5 text-slate-700" />
              <input
                type="date"
                value={filterDate}
                onChange={(e) => setFilterDate(e.target.value)}
                className="w-full pl-10 pr-4 py-2 border border-slate-200 text-slate-700 rounded-lg focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all bg-foreground"
              />
            </div>
          </div>
        </div>

        {/* History Table */}
        <div className="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-soft slide-in-up mb-5" style={{ animationDelay: '0.3s' }}>
          <div className="p-6 border-b border-slate-100">
            <h3 className="text-lg font-bold text-slate-900">Parking Sessions</h3>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Parking Lot</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Spot Code</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Date</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Entry Time</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Exit Time</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Duration</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Status</th>
                    <th className="px-6 py-3 text-left text-md font-semibold text-slate-900">Action</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {
                  loading ? <ListComponent isLoading={loading} /> : <ListComponent parkingHistory={parkingHistory} getStatusColor={getStatusColor} handleCheckout={handleTriggerCheckout} /> 
                }
              </tbody>
            </table>
          </div>
        </div>

        {
          parkingHistory.length > 0 && !loading && (
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

        {/* Empty State */}
        {parkingHistory.length === 0 && !loading && (
          <div className="text-center py-12">
            <AlertCircle className="h-12 w-12 text-slate-300 mx-auto mb-4" />
            <p className="text-lg font-medium text-slate-900">No parking history found</p>
            <p className="text-slate-600 mt-1">Try adjusting your search or date filter</p>
          </div>
        )}
      </main>

      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} theme="light" />
      }

      <Modal
        loading={loading} 
        open={modal.isOpen}
        title={modal.title}
        description={modal.message}
        fields={modal.fields}
        onSubmit={modal.onConfirm}
        onCancel={() => closemodal(setModal)}
        initialValues={modal.initialValues}
      />

    </div>
  )
}

const ListComponent = ({parkingHistory = [...Array(10)], getStatusColor = () => {}, isLoading, handleCheckout = () => {}}) => {
  return (
    parkingHistory.map((record, i) => (
      <tr key={i} className="hover:bg-slate-50 transition-colors">
        <td className="px-6 py-4 text-sm text-slate-600 font-semibold">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.parking_lot_name}</td>
        <td className="px-6 py-4 text-sm text-slate-600 font-semibold">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.spot_code}</td>
        <td className="px-6 py-4 text-sm text-slate-600">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.date}</td>
        <td className="px-6 py-4 text-sm text-slate-600">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.start_time}</td>
        <td className="px-6 py-4 text-sm text-slate-600">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.exit_time || '-'}</td>
        <td className="px-6 py-4 text-sm text-slate-600 font-medium">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : record.duration}</td>
        <td className="px-6 py-4 text-sm">
          {isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : (
            <span className={`px-3 py-1 rounded-lg text-xs font-semibold capitalize ${getStatusColor(record.status)}`}>
              {record.status}
            </span>
          )
          }
        </td>
        <td className="px-6 py-4 text-sm font-semibold text-slate-900">
          {isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : (
            record.status === 'active' ? (
              <button className='px-4 py-2 rounded-lg font-medium transition-all text-white bg-red-500' onClick={() => handleCheckout(record.id)}>
                Checkout
              </button>
            ) : (
              <span className={`px-3 py-1 rounded-lg text-xs font-semibold capitalize`}>
                -
              </span>
            )
          )
          }
        </td>
      </tr>
    ))
  )
}