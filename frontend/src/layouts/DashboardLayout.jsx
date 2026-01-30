import { Outlet } from 'react-router-dom'
import { useState } from 'react'
import { HeaderDashboard, SidebarDashboard } from '@/partials/dashboard'

function DashboardLayout() {
  const [sidebarOpen, setSidebarOpen] = useState(true)

  return (
    <div className="flex h-screen bg-gradient-to-br from-slate-950 via-indigo-950/20 to-slate-950">
      <SidebarDashboard open={sidebarOpen} />
      <div className="flex-1 flex flex-col overflow-hidden">
        <HeaderDashboard onToggleSidebar={() => setSidebarOpen(!sidebarOpen)} />
        <main className="flex-1 overflow-auto p-8 bg-gradient-to-b from-indigo-950/10 via-slate-950 to-slate-950">
          <Outlet />
        </main>
      </div>
    </div>
  )
}

export default DashboardLayout