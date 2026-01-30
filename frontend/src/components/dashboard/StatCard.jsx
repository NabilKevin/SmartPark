import { Skeleton } from "../ui/skeleton"

const StatCard = ({ loading, label, value }) => {
  return (
    <div className="bg-gradient-to-br from-slate-800/60 to-slate-900/60 border border-indigo-900/30 rounded-xl p-6 backdrop-blur-sm hover:border-indigo-900/60 transition-all duration-300">
      <p className="text-slate-400 text-lg font-medium mb-2">{label}</p>
      <div className="text-3xl font-bold text-slate-100">{loading ? <Skeleton className="h-4 w-20 bg-gray-700" /> : value}</div>
    </div>
  )
}

export default StatCard