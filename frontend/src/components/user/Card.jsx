import { Car, ChevronRight } from "lucide-react"
import { Skeleton } from "../ui/skeleton"
import { Link } from "react-router-dom"

const Card = ({lot, isLoading}) => {
  return (
    <div className="bg-white rounded-2xl border border-slate-100 hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
      {/* Header with availability */}
      <div className="p-6 pb-2 border-b border-slate-100">
        <div className="flex items-center justify-between mb-3">
          <div className="flex-1">
            <h4 className="text-lg font-bold text-slate-900">{isLoading ? <Skeleton className="h-4 w-40 bg-gray-400" /> : lot.name}</h4>
          </div>
          <div className="text-right">
            <div className="text-2xl font-bold text-green-600">{isLoading ? <Skeleton className="h-4 w-7 bg-gray-400 justify-self-end" /> : lot.available_spots}</div>
            <div className={`text-sm text-slate-500 ${isLoading ? 'mt-1' : ''}`}>{isLoading ? <Skeleton className="h-4 w-14 bg-gray-400" /> : 'available'}</div>
          </div>
        </div>
      </div>

      {/* Details */}
      <div className="p-6 space-y-3">

        <div className="flex items-center justify-between text-md">
          <span className="text-slate-600 flex items-center gap-2">
            {!isLoading && <Car className="h-4 w-4 text-slate-400" />}
            {isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : `Capacity`}
          </span>
          <span className="font-semibold text-slate-900">{isLoading ? <Skeleton className="h-4 w-20 bg-gray-400" /> : `${lot.capacity} spaces`}</span>
        </div>

        {/* Progress bar */}
        <div className="mt-4">
          <div className="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
            <div
              className="h-full bg-gradient-to-r from-green-500 to-green-400"
              style={{ width: `${isLoading ? 0 : (lot.available_spots / lot.capacity) * 100}%` }}
            ></div>
          </div>
          <div className="text-sm text-slate-500 mt-2">
            {isLoading ? <Skeleton className="h-4 w-[22%] bg-gray-400" /> : `${Math.round((lot.available_spots / lot.capacity) * 100)}% available`}
          </div>
        </div>

        {/* Book Button */}
        <Link
          to={`/parking-spots/${lot?.id}`}
          className="w-full mt-4 flex items-center justify-center gap-2 px-4 py-3 bg-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all font-semibold group-hover:shadow-lg"
        >
          Check Parking Lot
          <ChevronRight className="h-5 w-5" />
        </Link>
      </div>
    </div>
  )
}

export default Card