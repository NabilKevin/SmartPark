import { useNavigate, Link } from 'react-router-dom'
import { Lock, Eye, EyeOff, ArrowRight, UserRound } from 'lucide-react'
import { useState } from 'react'
import { login } from '@/services/authentication/AuthenticationService'

export default function Login() {
  const navigate = useNavigate()
  const [showPassword, setShowPassword] = useState(false)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState({})
  const [formdata, setFormdata] = useState({
    username: '',
    password: ''
  })

  const handleChange = (e) => {
    setFormdata(prev => ({
      ...prev,
      [e.target.name]: e.target.value
    }))
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError({})
    setLoading(true)
    try {
      const response = await login({...formdata}) 
      if(response.status === 200) {
        alert(response.data.message)
        const {user, token} = response.data.data

        localStorage.setItem('user', JSON.stringify(user))
        localStorage.setItem('token', token)
        if(user.role === 'admin') {
          navigate('/dashboard')
        } else {
          navigate('/')
        }
      }
    } catch(err) {
      setError(err.response.data)
    } finally {
      setLoading(false)
    }

  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-white via-slate-50 to-blue-50 flex items-center justify-center px-4 py-12">
      {/* Decorative elements */}
      <div className="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
      <div className="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>

      <div className="w-full max-w-md slide-in-up">
        {/* Header */}
        <div className="text-center mb-8">
          <h1 className="text-4xl font-bold text-slate-900 mb-2">Smart Park</h1>
          <p className="text-slate-500">Sign in to access your account</p>
        </div>

        {/* Form Card */}
        <div className="bg-white rounded-3xl shadow-lg p-8 border border-slate-100 backdrop-blur-sm">
          <form onSubmit={handleSubmit} className="space-y-6">
            {/* Username Field */}
            <div className="space-y-2">
              <label htmlFor="username" className="block text-sm font-semibold text-slate-700">
                Username
              </label>
              <div className="relative group">
                <UserRound className="absolute left-4 top-3.5 h-5 w-5 text-indigo-400 group-focus-within:text-indigo-600 transition-colors" />
                <input
                  required
                  id="username"
                  placeholder="John Doe"
                  value={formdata.username}
                  onChange={handleChange}
                  name='username'
                  className="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all hover:bg-slate-100 text-slate-700"
                />
                {
                  error.errors?.username && (
                    <p className="text-md text-red-500 mt-2">
                      {error.errors?.username}
                    </p>
                  )
                }
              </div>
            </div>

            {/* Password Field */}
            <div className="space-y-2">
              <label htmlFor="password" className="block text-sm font-semibold text-slate-700">
                Password
              </label>
              <div className="relative group">
                <Lock className="absolute left-4 top-3.5 h-5 w-5 text-indigo-400 group-focus-within:text-indigo-600 transition-colors" />
                <input
                  required
                  id="password"
                  type={showPassword ? 'text' : 'password'}
                  placeholder="••••••••"
                  value={formdata.password}
                  onChange={handleChange}
                  name='password'
                  className="text-slate-700 w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all hover:bg-slate-100"
                />
                {
                  error.errors?.password && (
                    <p className="text-md text-red-500 mt-2">
                      {error.errors?.password}
                    </p>
                  )
                }
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute right-4 top-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                >
                  {showPassword ? <EyeOff className="h-5 w-5" /> : <Eye className="h-5 w-5" />}
                </button>
              </div>
            </div>

            {/* Error Message */}
            {error.message && (
              <div className="p-3 bg-red-50 border border-red-200 rounded-xl flex gap-3">
                <p className="text-sm text-red-700 font-medium">{error.message}</p>
              </div>
            )}

            {/* Submit Button */}
            <button
              type="submit"
              disabled={loading}
              className="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 disabled:opacity-50 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
              {loading ? (
                <>
                  <div className="h-5 w-5 border-2 border-white border-t-transparent rounded-full animate-spin" />
                  Signing in...
                </>
              ) : (
                <>
                  Sign In
                  <ArrowRight className="h-5 w-5" />
                </>
              )}
            </button>

            {/* Divider */}
            <div className="relative my-6">
              <div className="absolute inset-0 flex items-center">
                <div className="w-full border-t border-slate-200"></div>
              </div>
              <div className="relative flex justify-center text-sm">
                <span className="px-3 bg-white text-slate-500 font-medium">New to SmartPark?</span>
              </div>
            </div>

            {/* Register Link */}
            <Link
              to="/register"
              className="w-full py-3 px-4 border-2 border-slate-200 text-slate-700 font-semibold rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-200 text-center flex items-center justify-center gap-2"
            >
              Create a Free Account
            </Link>
          </form>
        </div>
      </div>
    </div>
  )
}
