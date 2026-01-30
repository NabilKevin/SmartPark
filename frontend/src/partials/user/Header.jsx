import { useNavigate, useLocation } from 'react-router-dom'
import { LogOut } from 'lucide-react'
import CustomAlert, { toggleAlert } from '@/components/CustomAlert'
import { useState } from 'react'
import { logout } from '@/services/authentication/AuthenticationService'

export default function Header() {
  const navigate = useNavigate()
  const location = useLocation()
  const [loading, setLoading] = useState(false)

  const navItems = [
    { label: 'Home', path: '/' },
    { label: 'Parking Lots', path: '/parking-lots' },
    { label: 'History', path: '/parking-histories' },
  ]

  const isActive = (path) => location.pathname === path
  const user = JSON.parse(localStorage.getItem('user'))

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

  return (
    <header className="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-soft">
      <div className="max-w-7xl mx-auto px-6">
        <div className="flex items-center justify-between py-4">
          {/* Logo */}
          <div className="flex items-center gap-3">
            <div className="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center font-bold text-lg text-white cursor-pointer" onClick={() => navigate('/home')}>
              🅿️
            </div>
            <div onClick={() => navigate('/')} className="cursor-pointer">
              <h1 className="text-2xl font-bold text-slate-900">SmartPark</h1>
              <p className="text-xs text-slate-500">Find & Book Parking</p>
            </div>
          </div>

          {/* Navigation */}
          <nav className="hidden md:flex items-center gap-2">
            {navItems.map((item) => (
              <button
                key={item.path}
                onClick={() => navigate(item.path)}
                className={`px-4 py-2 rounded-lg font-medium transition-all ${
                  isActive(item.path)
                    ? 'bg-indigo-100 text-indigo-700'
                    : 'text-slate-600 hover:bg-slate-100'
                }`}
              >
                {item.label}
              </button>
            ))}
          </nav>

          {/* User Actions */}
          <div className="flex items-center gap-4">
            <div className="text-right">
              <p className="text-sm font-semibold text-slate-900">{user.username}</p>
              <p className="text-xs text-slate-500">Regular User</p>
            </div>
            <div className="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold">
              {user.username.charAt(0).toUpperCase()}
            </div>
            <button
              onClick={handleLogout}
              disabled={loading}
              className="flex items-center gap-2 px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors font-medium"
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
        </div>
      </div>
      {
        alert.isOpen && <CustomAlert variant={alert.variant} title={alert.title} message={alert.message} />
      }
    </header>
  )
}
