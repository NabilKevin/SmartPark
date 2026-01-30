import { AlertCircle, X } from "lucide-react"
import { useEffect, useState } from "react"

const Modal = ({
  open,
  title,
  description,
  fields = [], // array of field config
  confirmText = "Confirm",
  cancelText = "Cancel",
  onSubmit,
  onCancel,
  loading,
  errors = {},
  initialValues = {}
}) => {
  const [form, setForm] = useState({})

  useEffect(() => {
    if (open) {
      setForm(initialValues)
    } else {
      setForm({})
    }
  }, [open])

  if (!open) return null


  const handleChange = (name, value, type) => {
    setForm((prev) => ({
      ...prev,
      [name]:
        type === "number" && value !== ""
          ? Number(value)
          : value,
    }))
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    onSubmit(form)
  }

  const handleCancel = () => {
    setForm({})
    onCancel()
  }

  const visibleFields = fields.filter(
    (field) => !field.showIf || field.showIf(form)
  )


  const renderField = (field) => {
    const fieldErrors = errors[field.name]
    const commonProps = {
      name: field.name,
      value: form[field.name] ?? "",
      onChange: (e) =>
      handleChange(field.name, e.target.value, field.type),
      placeholder: field.placeholder,
      required: field.required,
      min: field.min,
      max: field.max,
      step: field.step,
      disabled: field.disabled,
      className: `w-full ${
        fieldErrors ? "border-red-500" : ""
      }`,
    }

    return (
      <div key={field.name} className="space-y-1">
        {field.label && (
          <label className="text-sm font-medium">
            {field.label}
          </label>
        )}

        {field.type === "textarea" ? (
          <textarea rows={field.rows ?? 3} {...commonProps} />
        ) : field.type === "select" ? (
          <select {...commonProps}>
            {field.options?.map((opt) => (
              <option key={opt.value} value={opt.value}>
                {opt.label}
              </option>
            ))}
          </select>
        ) : (
          <input type={field.type ?? "text"} {...commonProps} />
        )}

        {fieldErrors && (
          <p className="text-sm text-red-500">
            {fieldErrors[0]}
          </p>
        )}
      </div>
    )
  }

  return (
    <div className="fixed inset-0 z-40 flex items-center justify-center modal-backdrop bg-black/50">
      <div className="relative w-full max-w-md modal-content">
        {/* Modal card */}
        <div className="rounded-xl border border-purple-900/30 bg-gradient-to-br from-purple-950 to-blue-950 p-6 shadow-2xl">
          {/* Close button */}
          <button
            onClick={handleCancel}
            className="absolute right-4 top-4 text-gray-400 hover:text-gray-200 transition-colors"
            aria-label="Close modal"
          >
            <X size={20} />
          </button>

          {/* Header with icon */}
          <div className="flex items-center gap-3 mb-4">
            <div className="flex h-12 w-12 items-center justify-center rounded-full bg-amber-500/20">
              <AlertCircle className="h-6 w-6 text-amber-400" />
            </div>
            <h2 className="text-xl font-semibold text-white">{title}</h2>
          </div>

          {/* Message */}
          <p className="text-gray-300 mb-6 text-md leading-relaxed">{description}</p>

        <form onSubmit={handleSubmit} className="mt-4 space-y-3">
          {visibleFields.map(renderField)}

          <div className="mt-6 flex justify-end gap-2">
            <button type="button" onClick={handleCancel} className="flex-1 px-4 py-2.5 text-sm font-medium text-gray-300 border border-gray-600 rounded-lg hover:bg-gray-700/20 hover:border-gray-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed" >
              {cancelText}
            </button>
            <button
              type="submit"
              disabled={loading}
              className="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg hover:from-purple-500 hover:to-purple-600 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
            >
              {loading ? (
                <>
                  <div className="h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white" />
                  <span>Processing...</span>
                </>
              ) : (
                confirmText
              )}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  )
}

export const closemodal = (fn = () => {}) => {
  fn({
    isOpen: false,
    message: '',
    title: '',
    onConfirm: () => {},
    fields: []
  })
}

export default Modal