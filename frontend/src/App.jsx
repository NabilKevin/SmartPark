import { BrowserRouter as Router, Routes, Route, useNavigate } from 'react-router-dom'
import { useEffect, useState } from 'react'
import { adminRoutes, userRoutes } from './routes'
import authRoutes from './routes/public/authentication'
import { Loading } from './components'
import { me } from './services/dashboard/UserService'
import UserRoutes from './routes/private/user/userRoutes'
import { DashboardLayout, UserLayout } from './layouts'

function App() {
  const navigate = useNavigate()
  const path = location.pathname
  const [user, setUser] = useState({})
  const [loading, setLoading] = useState(true)

  const checkAuthorization = () => {
    let isAuthorize = false
    if(user.role === 'admin') {
      adminRoutes.forEach(route => {
        if(path.split('?')[0] === route.path) {
          isAuthorize = true
        }
      })
      
      if(!isAuthorize) {
        navigate('/dashboard')
      }
    } else {
      
      userRoutes.forEach(route => {
        if(path.split('?')[0] === route.path) {
          isAuthorize = true
        }
      })
      if(!isAuthorize) {
        navigate('/')
      }
    }
  }

  const fetchData = async () => {
    try {
      const response = await me()
      if(response.status === 200) {
        setUser(response.data.data)
      }
    } catch(err) {
      if(path !== '/register' && path !== '/login') {
        navigate('/login')
      }
    } finally {
      setTimeout(() => {
        setLoading(false)
      }, 500)
    }
  }

  useEffect(() => {
    fetchData()
  }, [])
  useEffect(() => {
    if(Object.keys(user).length > 0) {
      checkAuthorization()
    }
  }, [user])
  
  if(loading) {
    return <Loading />
  }

  return (
    <Routes>
      <Route element={<DashboardLayout />}>
        {adminRoutes.map((route, i) => (
          <Route key={i} path={route.path} element={route.element} />
        ))}
      </Route>
      
      <Route element={<UserLayout />}>
        {UserRoutes.map((route, i) => (
          <Route key={i} path={route.path} element={route.element} />
        ))}
      </Route>
      
      {authRoutes.map((route, i) => (
        <Route key={i} path={route.path} element={route.element} />
      ))}
    </Routes>
  )
}

export default App
