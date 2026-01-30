import { useState } from 'react'
import { Plus, Edit, X, MapPin, Clock, User } from 'lucide-react'

function Bookings() {
  const [parkingLots] = useState([
    { id: 1, name: 'Mall A - Floor 1' },
    { id: 2, name: 'Mall B - Ground Floor' },
    { id: 3, name: 'Airport P1' },
  ])

  const [bookings, setBookings] = useState([
    { id: 1, userId: 'John Doe', lotId: 1, spotNumber: 'A-01', status: 'booked', checkinTime: '2024-01-28 10:30', checkoutTime: null },
    { id: 2, userId: 'Jane Smith', lotId: 1, spotNumber: 'A-03', status: 'checkedin', checkinTime: '2024-01-28 11:00', checkoutTime: null },
    { id: 3, userId: 'Bob Johnson', lotId: 2, spotNumber: 'B-01', status: 'completed', checkinTime: '2024-01-28 09:00', checkoutTime: '2024-01-28 14:30' },
  ])

  const [modalOpen, setModalOpen] = useState(false)
  const [editingId, setEditingId] = useState(null)
  const { formData, setFormData, resetForm } = useState({
    userId: '',
    lotId: '',
    spotNumber: '',
    status: 'booked',
  })

  const handleSubmit = (e) => {
    e.preventDefault()
    if (editingId) {
      setBookings(bookings.map(booking =>
        booking.id === editingId
          ? { ...booking, ...formData, lotId: parseInt(formData.lotId) }
          : booking
      ))
    } else {
      setBookings([...bookings, {
        id: Date.now(),
        ...formData,
        lotId: parseInt(formData.lotId),
        checkinTime: new Date().toLocaleString(),
        checkoutTime: null
      }])
    }
    closeModal()
  }

  const handleCheckIn = (id) => {
    setBookings(bookings.map(booking =>
      booking.id === id
        ? { ...booking, status: 'checkedin', checkinTime: new Date().toLocaleString() }
        : booking
    ))
  }

  const handleCheckOut = (id) => {
    setBookings(bookings.map(booking =>
      booking.id === id
        ? { ...booking, status: 'completed', checkoutTime: new Date().toLocaleString() }
        : booking
    ))
  }

  const handleRelocate = (id) => {
    setEditingId(id)
    const booking = bookings.find(b => b.id === id)
    setFormData({
      userId: booking.userId,
      lotId: booking.lotId,
      spotNumber: booking.spotNumber,
      status: booking.status,
    })
    setModalOpen(true)
  }

  const handleCancel = (id) => {
    setBookings(bookings.filter(booking => booking.id !== id))
  }

  const totalBookings = bookings.length
  const bookedCount = bookings.filter(b => b.status === 'booked').length
  const checkedInCount = bookings.filter(b => b.status === 'checkedin').length
  const completedCount = bookings.filter(b => b.status === 'completed').length

  const closeModal = () => {
    setModalOpen(false)
    setEditingId(null)
    resetForm()
  }

  const getLotName = (lotId) => {
    return parkingLots.find(lot => lot.id === lotId)?.name || 'Unknown'
  }

  const getStatusColor = (status) => {
    switch (status) {
      case 'booked':
        return 'bg-blue-600/20 text-blue-400 border-blue-600/30'
      case 'checkedin':
        return 'bg-emerald-600/20 text-emerald-400 border-emerald-600/30'
      case 'completed':
        return 'bg-purple-600/20 text-purple-400 border-purple-600/30'
      default:
        return 'bg-slate-600/20 text-slate-400 border-slate-600/30'
    }
  }

  const getStatusLabel = (status) => {
    switch (status) {
      case 'booked':
        return 'Booked'
      case 'checkedin':
        return 'Checked In'
      case 'completed':
        return 'Completed'
      default:
        return status
    }
  }

  return (
    <div className="space-y-8">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-4xl font-bold bg-gradient-to-r from-indigo-300 to-pink-300 bg-clip-text text-transparent">Bookings</h1>
          <p className="text-slate-400 mt-2">Manage parking bookings, check-ins, and relocations</p>
        </div>
        <button
          onClick={() => setModalOpen(true)}
          className="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-2.5 rounded-lg transition-all duration-200 shadow-lg shadow-indigo-500/30 font-medium"
        >
          <Plus size={20} />
          Create Booking
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <StatCard
          label="Total Bookings"
          value={totalBookings}
          icon="📋"
          bgGradient="from-indigo-600 to-indigo-700"
        />
        <StatCard
          label="Booked"
          value={bookedCount}
          icon="📅"
          bgGradient="from-blue-600 to-blue-700"
        />
        <StatCard
          label="Checked In"
          value={checkedInCount}
          icon="✓"
          bgGradient="from-green-600 to-emerald-600"
        />
        <StatCard
          label="Completed"
          value={completedCount}
          icon="🏁"
          bgGradient="from-purple-600 to-purple-700"
        />
      </div>

      {/* Bookings List */}
      <div className="space-y-3">
        {bookings.map(booking => (
          <div key={booking.id} className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-5 hover:border-indigo-900/60 transition-all duration-200 backdrop-blur-sm">
            <div className="flex items-start justify-between">
              <div className="flex-1">
                <div className="flex items-center gap-3 mb-3">
                  <div className="w-10 h-10 rounded-lg bg-indigo-600/20 flex items-center justify-center text-indigo-400">
                    <User size={20} />
                  </div>
                  <div>
                    <h3 className="text-lg font-bold text-slate-100">{booking.userId}</h3>
                    <span className={`inline-block px-3 py-1 rounded-full text-sm font-medium border ${getStatusColor(booking.status)}`}>
                      {getStatusLabel(booking.status)}
                    </span>
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
                  <div className="flex items-center gap-2 text-slate-300">
                    <MapPin size={16} className="text-indigo-400" />
                    <div>
                      <p className="text-xs text-slate-500 font-medium">Parking Lot</p>
                      <p className="font-semibold">{getLotName(booking.lotId)}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-2 text-slate-300">
                    <MapPin size={16} className="text-indigo-400" />
                    <div>
                      <p className="text-xs text-slate-500 font-medium">Spot</p>
                      <p className="font-semibold">{booking.spotNumber}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-2 text-slate-300">
                    <Clock size={16} className="text-indigo-400" />
                    <div>
                      <p className="text-xs text-slate-500 font-medium">Check-in</p>
                      <p className="font-semibold">{booking.checkinTime}</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Action Buttons */}
              <div className="flex flex-col gap-2 ml-4">
                {booking.status === 'booked' && (
                  <button
                    onClick={() => handleCheckIn(booking.id)}
                    className="px-3 py-1.5 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 rounded-lg transition-all duration-200 text-sm font-medium border border-emerald-600/30"
                  >
                    Check In
                  </button>
                )}
                {booking.status === 'checkedin' && (
                  <button
                    onClick={() => handleCheckOut(booking.id)}
                    className="px-3 py-1.5 bg-purple-600/20 hover:bg-purple-600/30 text-purple-400 rounded-lg transition-all duration-200 text-sm font-medium border border-purple-600/30"
                  >
                    Check Out
                  </button>
                )}
                <button
                  onClick={() => handleRelocate(booking.id)}
                  className="px-3 py-1.5 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 rounded-lg transition-all duration-200 text-sm font-medium border border-blue-600/30"
                >
                  Relocate
                </button>
                <button
                  onClick={() => handleCancel(booking.id)}
                  className="px-3 py-1.5 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg transition-all duration-200 text-sm font-medium border border-red-600/30"
                >
                  Cancel
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Modal */}
      {/* <ModalDashboard isOpen={modalOpen} onClose={closeModal} title={editingId ? 'Update Booking' : 'Create Booking'}>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-semibold text-slate-300 mb-2">User Name</label>
            <input
              type="text"
              name="userId"
              value={formData.userId}
              onChange={(e) => setFormData({ ...formData, userId: e.target.value })}
              className="w-full bg-slate-800/50 border border-indigo-900/30 rounded-lg px-4 py-2 text-slate-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50"
              required
            />
          </div>
          <div>
            <label className="block text-sm font-semibold text-slate-300 mb-2">Parking Lot</label>
            <select
              name="lotId"
              value={formData.lotId}
              onChange={(e) => setFormData({ ...formData, lotId: e.target.value })}
              className="w-full bg-slate-800/50 border border-indigo-900/30 rounded-lg px-4 py-2 text-slate-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50"
              required
            >
              <option value="">Select a lot</option>
              {parkingLots.map(lot => (
                <option key={lot.id} value={lot.id}>{lot.name}</option>
              ))}
            </select>
          </div>
          <div>
            <label className="block text-sm font-semibold text-slate-300 mb-2">Spot Number</label>
            <input
              type="text"
              name="spotNumber"
              value={formData.spotNumber}
              onChange={(e) => setFormData({ ...formData, spotNumber: e.target.value })}
              className="w-full bg-slate-800/50 border border-indigo-900/30 rounded-lg px-4 py-2 text-slate-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50"
              required
            />
          </div>
          <div className="flex gap-2 pt-4">
            <button
              type="submit"
              className="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-2 rounded-lg transition-all duration-200"
            >
              {editingId ? 'Update' : 'Create'}
            </button>
            <button
              type="button"
              onClick={closeModal}
              className="flex-1 bg-slate-700/50 hover:bg-slate-700 text-slate-100 font-medium py-2 rounded-lg transition-all duration-200"
            >
              Cancel
            </button>
          </div>
        </form>
      </ModalDashboard> */}
    </div>
  )
}

function StatCard({ label, value, icon, bgGradient }) {
  return (
    <div className="bg-gradient-to-br from-slate-800/60 to-slate-900/60 border border-indigo-900/30 rounded-xl p-6 backdrop-blur-sm hover:border-indigo-900/60 transition-all duration-300">
      <div className="flex items-start justify-between mb-4">
        <div className={`bg-gradient-to-br ${bgGradient} p-3 rounded-lg text-2xl`}>
          {icon}
        </div>
      </div>
      <p className="text-slate-400 text-sm font-medium mb-2">{label}</p>
      <p className="text-3xl font-bold text-slate-100">{value}</p>
    </div>
  )
}

export default Bookings
