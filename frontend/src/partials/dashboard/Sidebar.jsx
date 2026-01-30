import { Link, useLocation, useNavigate } from 'react-router-dom'
import { LayoutDashboard, ParkingCircle, ParkingSquare, Users, Bookmark, User, LogOut, ChevronRight } from 'lucide-react'
import { logout } from '@/services/authentication/AuthenticationService'
import { CustomAlert } from '@/components'
import { useEffect, useState } from 'react'

function Sidebar({ open }) {
  const location = useLocation()
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)

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

  const menuItems = [
    { path: '/dashboard/', icon: LayoutDashboard, label: 'Dashboard' },
    { path: '/dashboard/parking-lots', icon: ParkingCircle, label: 'Parking Lots' },
    { path: '/dashboard/parking-spots', icon: ParkingSquare, label: 'Parking Spots' },
    { path: '/dashboard/users', icon: Users, label: 'Users' },
    // { path: '/dashboard/bookings', icon: Bookmark, label: 'Bookings' },
    { path: '/dashboard/profile', icon: User, label: 'Profile' },
  ]

  const handleLogout = async () => {
    if(!loading) {
      setLoading(true)
      try {
        const response = await logout()
        if(response.status === 200) {
          window.alert(response.data.message)
          
          localStorage.removeItem('token')
          navigate('/login')
        }
      } catch(err) {
        toggleAlert('Error', err?.response.data.message, 'danger')
      } finally {
        setLoading(false)
      }
    }
  }

  useEffect(() => {
    if (!alert.isOpen) return

    const timer = setTimeout(() => {
      toggleAlert(setAlert)
    }, 5000)

    return () => clearTimeout(timer)
  }, [alert.isOpen])

  return (
    <aside className={`${open ? 'w-72' : 'w-0'} bg-gradient-to-b from-indigo-950 via-slate-900 to-slate-950 border-r border-indigo-900/30 transition-all duration-300 overflow-hidden flex flex-col h-screen sticky top-0 shadow-2xl`}>
      {/* Logo Section */}
      <div className="px-6 py-8 border-b border-indigo-900/20 bg-gradient-to-r from-indigo-950/80 to-transparent">
        <div className="flex items-center gap-3">
          <div className="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-indigo-500/40">
            <ParkingCircle size={24} className="text-white" />
          </div>
          <div className="flex-1 min-w-0">
            <h1 className="text-xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent truncate">SmartPark</h1>
            <p className="text-xs text-indigo-400/70">Management System</p>
          </div>
        </div>
      </div>

      {/* Navigation */}
      <nav className="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto scrollbar-hide">
        {menuItems.map((item) => {
          const Icon = item.icon
          const isActive = location.pathname === item.path
          
          return (
            <Link
              key={item.path}
              to={item.path}
              className={`group flex items-center justify-between px-4 py-3.5 rounded-lg transition-all duration-200 relative ${
                isActive
                  ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-500/30'
                  : 'text-slate-300 hover:text-indigo-200 hover:bg-indigo-900/20'
              }`}
            >
              <div className="flex items-center gap-3 flex-1 min-w-0">
                <Icon size={20} className="flex-shrink-0" />
                <span className="font-medium text-sm truncate">{item.label}</span>
              </div>
              
              {isActive && (
                <ChevronRight size={18} className="flex-shrink-0 ml-2 group-hover:translate-x-1 transition-transform" />
              )}
            </Link>
          )
        })}
      </nav>

      {/* Logout Section */}
      <div className="p-4 border-t border-indigo-900/20 bg-indigo-950/30 backdrop-blur-sm">
        <button 
          className="w-full flex items-center gap-3 px-4 py-3.5 rounded-lg text-slate-300 hover:text-white hover:bg-red-600/20 transition-all duration-200 group font-medium text-sm"
          onClick={handleLogout}
          disabled={loading}
        >
          {
            loading ? (
              <div className="h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white" />
            ) : (
              <LogOut size={20} className="flex-shrink-0 group-hover:scale-110 transition-transform" />
            )
          }
          <span>{!loading ? 'Logout' : 'Processing...'}</span>
        </button>
      </div>
      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} />
      }
    </aside>

  )
}

export default Sidebar
