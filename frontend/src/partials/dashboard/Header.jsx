import { Menu, Bell, Settings } from 'lucide-react'

function Header({ onToggleSidebar }) {
  const user = JSON.parse(localStorage.getItem('user'))
  return (
    <header className="bg-gradient-to-r from-indigo-950/60 via-slate-900/60 to-slate-900/40 backdrop-blur-xl border-b border-indigo-900/30 px-8 py-4 flex items-center justify-between sticky top-0 z-40 shadow-lg">
      <button
        onClick={onToggleSidebar}
        className="p-2 hover:bg-indigo-900/30 rounded-lg transition-all duration-200 text-slate-300 hover:text-indigo-200"
      >
        <Menu size={24} />
      </button>

      <div className="flex items-center gap-2">
        <button className="p-2 hover:bg-indigo-900/30 rounded-lg transition-all duration-200 text-slate-300 hover:text-indigo-200 relative group">
          <Bell size={20} />
          <span className="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-rose-500 rounded-full animate-pulse"></span>
        </button>
        <button className="p-2 hover:bg-indigo-900/30 rounded-lg transition-all duration-200 text-slate-300 hover:text-indigo-200">
          <Settings size={20} />
        </button>
        <div className="flex items-center gap-3 pl-4 ml-2 border-l border-indigo-900/30">
          <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/40">
            A
          </div>
          <div className="hidden sm:block">
            <p className="text-sm font-medium text-slate-100">{user.username}</p>
            <p className="text-xs text-slate-400">{user.role}</p>
          </div>
        </div>
      </div>
    </header>
  )
}

export default Header
