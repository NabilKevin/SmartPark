const Dropdown = ({name = '', value = '', onChange = () => {}, data = [], callback = () => {}}) => {
  return (
    <div className="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-indigo-900/30 rounded-xl p-4 backdrop-blur-sm">
      <label className="text-md font-semibold text-slate-300 block mb-3">Filter by {name}</label>
      <select
        value={value}
        onChange={(e) => onChange(callback, e.target.value)}
        className="w-full bg-slate-800/50 border border-indigo-900/30 rounded-lg px-4 py-2 text-slate-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600/50"
      >
        <option value="">All {name}</option>
        {data.map(d => (
          <option key={d?.id ?? d} value={d.id ?? d}>{d.name ?? d}</option>
        ))}
      </select>
    </div>
  )
}

export default Dropdown