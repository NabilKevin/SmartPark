import { Dashboard, BookingsDashboard, ParkingLotsDashboard, ParkingSpotsDashboard, ProfileDashboard, UsersDashboard } from "@/pages/dashboard"

const prefix = '/dashboard'

const DashboardRoutes = [
  {
    path: prefix,
    element: <Dashboard />
  },

  // Parking Lot
  {
    path: `${prefix}/parking-lots`,
    element: <ParkingLotsDashboard />
  },

  // Parking Spot
  {
    path: `${prefix}/parking-spots`,
    element: <ParkingSpotsDashboard />
  },

  // Users
  {
    path: `${prefix}/users`,
    element: <UsersDashboard />
  },

  // Bookings
  // {
  //   path: `${prefix}/bookings`,
  //   element: <BookingsDashboard />
  // },

  // Profile
  {
    path: `${prefix}/profile`,
    element: <ProfileDashboard />
  },
]

export default DashboardRoutes