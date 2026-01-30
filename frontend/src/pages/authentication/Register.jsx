import { useNavigate, Link } from 'react-router-dom'
import { Mail, Lock, User, Phone, Eye, EyeOff, ArrowRight, CheckCircle } from 'lucide-react'
import { useState } from 'react'
import { register } from '@/services/authentication/AuthenticationService'

export default function Register() {
  const navigate = useNavigate()
  const [formdata, setFormdata] = useState({
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
  })
  const [showPassword, setShowPassword] = useState(false)
  const [showConfirmPassword, setShowConfirmPassword] = useState(false)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState('')

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
      const response = await register({...formdata}) 
      if(response.status === 200) {
        alert(response.data.message)
        navigate('/login')
      }
    } catch(err) {
      setError(err.response.data)
    } finally {
      setLoading(false)
    }

  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-white via-slate-50 to-purple-50 flex items-center justify-center px-4 py-12">
      {/* Decorative elements */}
      <div className="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
      <div className="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-indigo-100 to-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>

      <div className="w-full max-w-md slide-in-up">
        {/* Header */}
        <div className="text-center mb-8">
          <h1 className="text-4xl font-bold text-slate-900 mb-2">Join SmartPark</h1>
          <p className="text-slate-500">Create your account in just a few steps</p>
        </div>

        {/* Form Card */}
        <div className="bg-white rounded-3xl shadow-lg p-8 border border-slate-100 backdrop-blur-sm">
          <form onSubmit={handleSubmit} className="space-y-5">
            {/* Name Field */}
            <div className="space-y-2">
              <label htmlFor="username" className="block text-sm font-semibold text-slate-700">
                Username
              </label>
              <div className="relative group">
                <User className="absolute left-4 top-3.5 h-5 w-5 text-purple-400 group-focus-within:text-purple-600 transition-colors" />
                <input
                  id="username"
                  type="text"
                  name="username"
                  placeholder="John Doe"
                  value={formdata.username}
                  onChange={handleChange}
                  className="text-slate-700 w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all hover:bg-slate-100"
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

            {/* Email Field */}
            <div className="space-y-2">
              <label htmlFor="email" className="block text-sm font-semibold text-slate-700">
                Email Address
              </label>
              <div className="relative group">
                <Mail className="absolute left-4 top-3.5 h-5 w-5 text-purple-400 group-focus-within:text-purple-600 transition-colors" />
                <input
                  id="email"
                  type="email"
                  name="email"
                  placeholder="you@example.com"
                  value={formdata.email}
                  onChange={handleChange}
                  className="text-slate-700 w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all hover:bg-slate-100"
                />
                {
                  error.errors?.email && (
                    <p className="text-md text-red-500 mt-2">
                      {error.errors?.email}
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
                <Lock className="absolute left-4 top-3.5 h-5 w-5 text-purple-400 group-focus-within:text-purple-600 transition-colors" />
                <input
                  id="password"
                  type={showPassword ? 'text' : 'password'}
                  name="password"
                  placeholder="••••••••"
                  value={formdata.password}
                  onChange={handleChange}
                  className="text-slate-700 w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all hover:bg-slate-100"
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

            {/* Confirm Password Field */}
            <div className="space-y-2">
              <label htmlFor="confirmPassword" className="block text-sm font-semibold text-slate-700">
                Confirm Password
              </label>
              <div className="relative group">
                <Lock className="absolute left-4 top-3.5 h-5 w-5 text-purple-400 group-focus-within:text-purple-600 transition-colors" />
                <input
                  id="confirmPassword"
                  type={showConfirmPassword ? 'text' : 'password'}
                  name="password_confirmation"
                  placeholder="••••••••"
                  value={formdata.confirmPassword}
                  onChange={handleChange}
                  className="text-slate-700 w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all hover:bg-slate-100"
                />                
                {
                  error.errors?.password_confirmation && (
                    <p className="text-md text-red-500 mt-2">
                      {error.errors?.password_confirmation}
                    </p>
                  )
                }
                <button
                  type="button"
                  onClick={() => setShowConfirmPassword(!showConfirmPassword)}
                  className="absolute right-4 top-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                >
                  {showConfirmPassword ? <EyeOff className="h-5 w-5" /> : <Eye className="h-5 w-5" />}
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
              className="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 disabled:opacity-50 transition-all duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6"
            >
              {loading ? (
                <>
                  <div className="h-5 w-5 border-2 border-white border-t-transparent rounded-full animate-spin" />
                  Creating Account...
                </>
              ) : (
                <>
                  Create Account
                  <ArrowRight className="h-5 w-5" />
                </>
              )}
            </button>

            {/* Divider */}
            <div className="relative !my-6">
              <div className="absolute inset-0 flex items-center">
                <div className="w-full border-t border-slate-200"></div>
              </div>
              <div className="relative flex justify-center text-sm">
                <span className="px-3 bg-white text-slate-500 font-medium">Already have an account?</span>
              </div>
            </div>

            {/* Login Link */}
            <Link
              to="/login"
              className="w-full py-3 px-4 border-2 border-slate-200 text-slate-700 font-semibold rounded-xl hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 text-center"
            >
              Sign In Instead
            </Link>
          </form>
        </div>

        {/* Benefits */}
        <div className="mt-8 space-y-3">
          <div className="flex gap-3 items-start">
            <CheckCircle className="h-5 w-5 text-green-500 flex-shrink-0 mt-0.5" />
            <p className="text-sm text-slate-600"><span className="font-semibold text-slate-900">Free to use</span> - No hidden fees</p>
          </div>
          <div className="flex gap-3 items-start">
            <CheckCircle className="h-5 w-5 text-green-500 flex-shrink-0 mt-0.5" />
            <p className="text-sm text-slate-600"><span className="font-semibold text-slate-900">Secure</span> - Your data is protected</p>
          </div>
        </div>
      </div>
    </div>
  )
}
