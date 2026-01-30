import { Homepage, ParkingHistory, ParkingLot } from "@/pages/user"
import ParkingSpot from "@/pages/user/ParkingSpot"


const UserRoutes = [
  {
    path: '/',
    element: <Homepage />
  },
  {
    path: '/parking-lots',
    element: <ParkingLot />
  },
  {
    path: '/parking-spots/:id',
    element: <ParkingSpot />
  },
  {
    path: '/parking-histories',
    element: <ParkingHistory />
  },
]

export default UserRoutes