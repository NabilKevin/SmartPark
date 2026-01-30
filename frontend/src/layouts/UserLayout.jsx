import { Outlet } from 'react-router-dom'
import { useState } from 'react'
import { HeaderUser } from '@/partials/user'

function UserLayout() {
  const [sidebarOpen, setSidebarOpen] = useState(true)

  return (
    <div className="flex h-screen bg-white">
      <div className="flex-1 flex flex-col overflow-hidden">
        <HeaderUser />
        <main className="flex-1 overflow-auto p-8">
          <Outlet />
        </main>
      </div>
    </div>
  )
}

export default UserLayout