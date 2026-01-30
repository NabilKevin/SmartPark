import { Login, Register } from "@/pages/authentication"

const AuthenticationRoutes = [
  {
    path: '/login',
    element: <Login />
  },
  {
    path: '/register',
    element: <Register />
  },
]

export default AuthenticationRoutes