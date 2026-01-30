import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { Clock, ChevronRight } from 'lucide-react'
import { getParkingLots } from '@/services/user/ParkingLot'
import { CardParkingLot, CustomAlert } from '@/components'
import { getParkingHistories } from '@/services/user/ParkingBook'
import { Skeleton } from '@/components/ui/skeleton'
import { toggleAlert } from '@/components/CustomAlert'

export default function Homepage() {
  const [loadingParkingLot, setLoadingParkingLot] = useState(true)
  const [loadingParkingHistory, setLoadingParkingHistory] = useState(true)
  const [parkingLots, setParkingLots] = useState([])
  const [parkingHistories, setParkingHistories] = useState([])

  const [alert, setAlert] = useState({
    isOpen: false,
    title: '',
    message: '',
    variant: ''
  })

  const fetchData = async () => {
    try {
      const response = await getParkingLots({limit: 3})
      if(response.status === 200) {
        setParkingLots(response.data.data)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoadingParkingLot(false)
    }

    try {
      const response = await getParkingHistories({limit: 3})
      if(response.status === 200) {
        setParkingHistories(response.data.data)
      }
    } catch(err) {
      toggleAlert(setAlert, 'Error', err?.response.data.message, 'danger')
    } finally {
      setLoadingParkingHistory(false)
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
    <div className="min-h-screen bg-gradient-to-br from-white via-slate-50 to-blue-50">
      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-6 py-8 space-y-8">
        {/* Welcome Section */}
        <div className="slide-in-up">
          <h2 className="text-3xl font-bold text-slate-900 mb-2">Find Your Perfect Parking</h2>
          <p className="text-slate-600">Browse available parking lots, check real-time availability, and book your spot</p>
        </div>

        {/* Parking Lots Grid */}
        <div className="slide-in-up" style={{ animationDelay: '0.2s' }}>
          <h3 className="text-xl font-bold text-slate-900 mb-4">Available Parking Lots</h3>
          <div className={`grid grid-cols-1 gap-6 ${parkingLots.length >= 2 || loadingParkingLot ? 'md:grid-cols-2' : ''} ${parkingLots.length >= 3 || loadingParkingLot ? 'lg:grid-cols-3' : ''}`}>
            {parkingLots.map((lot, i) => (
              <CardParkingLot lot={lot} key={i}/>
            ))}
            {
              loadingParkingLot && (
                [...Array(3)].map((_, i) => (
                  <CardParkingLot key={i} isLoading={true} />
                ))
              )
            }
          </div>
        </div>
        <Link
          to="/parking-lots"
          onClick={() => setSelectedLot(lot)}
          className="hover:text-white w-full mt-4 flex items-center justify-center gap-2 px-4 py-3 bg-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all font-semibold group-hover:shadow-lg"
        >
          See All Parking Lot
          <ChevronRight className="h-5 w-5" />
        </Link>

        {/* Parking History Section */}
        <div className="slide-in-up" style={{ animationDelay: '0.3s' }}>
          <div className="bg-white rounded-2xl border border-slate-100 shadow-soft overflow-hidden">
            <div className="p-6 border-b border-slate-100">
              <h3 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                <Clock className="h-6 w-6 text-indigo-600" />
                Recent Parking History
              </h3>
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
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100">
                  {parkingHistories.map((record, i) => (
                    <TableContent key={i} record={record} />
                  ))}
                  {
                    loadingParkingHistory && (
                      [...Array(5)].map((_, i) => (
                        <TableContent key={i} isLoading={true} />
                      ))
                    )
                  }
                </tbody>
              </table>
              {
                !loadingParkingHistory && parkingHistories.length === 0 && (
                  <span className='text-slate-800 text-center text-4xl m-6 p-6 block font-medium'>You have never booked a parking spot!</span>
                )
              }
            </div>
          </div>
        </div>
      </main>

      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} theme='light' />
      }
    </div>
  )
}

const TableContent = ({record, isLoading}) => {
  return (
    <tr className="hover:bg-slate-50 transition-colors">
      <td className="px-6 py-4 text-md font-medium text-slate-900">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.parking_lot_name}</td>
      <td className="px-6 py-4 text-md font-medium text-slate-900">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.spot_code}</td>
      <td className="px-6 py-4 text-md text-slate-600">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.date}</td>
      <td className="px-6 py-4 text-md text-slate-600">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.start_time}</td>
      <td className="px-6 py-4 text-md text-slate-600">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.exit_time}</td>
      <td className="px-6 py-4 text-md text-slate-600 font-medium">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : record.duration}</td>
    </tr>
  )
}