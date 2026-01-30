import { useEffect, useState } from 'react'
import { PieChart, Pie, BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer, Cell } from 'recharts'
import { Users, ParkingCircle, Bookmark, TrendingUp, ArrowUpRight, Clock } from 'lucide-react'
import { getSummary } from '@/services/dashboard/DashboardService'
import { CustomAlert, StatCard } from '@/components'

function Dashboard() {
  const [stats, setStats] = useState({
    totalUsers: '',
    totalParkingLots: '',
    activeBookings: '',
    occupancyRate: '',
  })

  const [occupancyData, setOccupancyData] = useState([])

  const [lotData, setLotData] = useState([])

  const COLORS = ['#10b981', '#ef4444', '#f59e0b']

  const [loading, setLoading] = useState(true)

  const [alert, setAlert] = useState({
    isOpen: false,
    title: '',
    message: '',
    variant: ''
  })

  const toggleAlert = (title = '', message = '', variant = '') => {
    setAlert(prev => ({
      isOpen: !prev.isOpen,
      title,
      message,
      variant
    }))
  }

  const fetchData = async () => {
    try {
      const response = await getSummary();
      if(response.status === 200) {
        console.log(response.data?.data);
        
        setStats(response.data?.data)
        setOccupancyData([
          { name: 'Available', value: response.data?.data.availableRate },
          { name: 'Occupied', value: response.data?.data.occupancyRate },
          { name: 'Broken', value: response.data?.data.brokenRate },
        ])
        setLotData(response.data?.data.lotOccupancy || [])
      }
    } catch(err) {
      toggleAlert('Error', err?.response.data.message, 'danger')
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
      <div className="flex justify-between items-start">
        <div>
          <h1 className="text-4xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent">Dashboard</h1>
          <p className="text-slate-400 mt-2">Welcome back! Here's your parking system overview.</p>
        </div>
      </div>

      {/* Stats Cards Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <StatCard
          loading={loading}
          label="Total Users"
          value={stats.totalUsers}
        />
        <StatCard
          loading={loading}
          label="Parking Lots"
          value={stats.totalParkingLots}
        />
        <StatCard
          loading={loading}
          label="Active Bookings"
          value={stats.activeBookings}
        />
        <StatCard
          loading={loading}
          label="Occupancy Rate"
          value={`${stats.occupancyRate}${stats.occupancyRate !== '-' ? '%' : ''}`}
        />
      </div>

      {/* Charts Section */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Overall Occupancy */}
        <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-6 backdrop-blur-sm">
          <h2 className="text-lg font-semibold text-slate-100 mb-6">Overall Occupancy</h2>
          <ResponsiveContainer width="100%" height={300}>
            <PieChart>
              <Pie
                data={occupancyData}
                cx="50%"
                cy="50%"
                labelLine={false}
                label={({ name, value }) => `${name}: ${value}%`}
                outerRadius={90}
                fill="#8884d8"
                dataKey="value"
              >
                {occupancyData.map((entry, index) => (
                  <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                ))}
              </Pie>
              <Tooltip contentStyle={{ backgroundColor: '#1e293b', border: '1px solid #4c1d95', borderRadius: '8px' }} />
            </PieChart>
          </ResponsiveContainer>
        </div>

        {/* Lot Occupancy Chart */}
        <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-6 backdrop-blur-sm">
          <h2 className="text-lg font-semibold text-slate-100 mb-6">Occupancy per Lot</h2>
          <ResponsiveContainer width="100%" height={300}>
            <BarChart data={lotData}>
              <CartesianGrid strokeDasharray="3 3" stroke="#4c1d95" opacity={0.2} />
              <XAxis dataKey="name" stroke="#94a3b8" style={{ fontSize: '12px' }} />
              <YAxis stroke="#94a3b8" style={{ fontSize: '12px' }} />
              <Tooltip contentStyle={{ backgroundColor: '#1e293b', border: '1px solid #4c1d95', borderRadius: '8px' }} />
              <Legend />
              <Bar dataKey="available" stackId="a" fill="#10b981" radius={[8, 8, 0, 0]} />
              <Bar dataKey="occupied" stackId="a" fill="#ef4444" radius={[8, 8, 0, 0]} />
              <Bar dataKey="broken" stackId="a" fill="#f59e0b" radius={[8, 8, 0, 0]} />
            </BarChart>
          </ResponsiveContainer>
        </div>
      </div>

      {/* Recent Activity */}
      {/* <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-6 backdrop-blur-sm">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-lg font-semibold text-slate-100">Recent Bookings</h2>
          <a href="#" className="text-indigo-400 hover:text-indigo-300 text-sm font-medium transition-colors">View All</a>
        </div>
        <div className="space-y-3">
          {[
            { user: 'Sarah Johnson', location: 'Mall A - Floor 1', time: '2 hours ago' },
            { user: 'Michael Chen', location: 'Airport P1 - Level 2', time: '45 minutes ago' },
            { user: 'Emma Davis', location: 'Downtown - Street Level', time: '30 minutes ago' },
            { user: 'James Wilson', location: 'Mall B - Basement', time: '15 minutes ago' },
          ].map((item, idx) => (
            <div key={idx} className="flex items-center justify-between p-4 bg-indigo-950/30 rounded-lg hover:bg-indigo-950/50 transition-all duration-200 border border-indigo-900/20">
              <div className="flex-1">
                <p className="font-semibold text-slate-100">{item.user}</p>
                <p className="text-slate-400 text-sm">{item.location}</p>
              </div>
              <div className="flex items-center gap-2 text-slate-400">
                <Clock size={16} />
                <span className="text-sm">{item.time}</span>
              </div>
            </div>
          ))}
        </div>
      </div> */}
      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} />
      }
    </div>
  )
}
export default Dashboard
