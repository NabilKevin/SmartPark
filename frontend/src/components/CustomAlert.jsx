import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert"
import { AlertCircleIcon, CheckCircle2Icon } from "lucide-react"

const CustomAlert = ({title= '', message = '', variant, theme = 'dark'}) => {
  return (
    <Alert variant={variant === 'danger' ? "destructive" : ''} className={`max-w-md fixed left-1/2 -translate-x-1/2 delay-300 z-50 alertShow top-20 py-4 px-5 ${theme === 'light' ? 'bg-foreground' : ''}`}>
      {
        variant === 'danger' ? <AlertCircleIcon /> : <CheckCircle2Icon />
      }
      <AlertTitle className={`text-xl font-bold ${variant !== 'danger' && theme === 'light' ? 'text-black' : ''}`}>{title}</AlertTitle>
      <AlertDescription className={`text-lg font-medium ${variant !== 'danger' && theme === 'light' ? 'text-black' : ''}`}>
        {message}
      </AlertDescription>
    </Alert>
  )
}

export const toggleAlert = (fn = () => {}, title = '', message = '', variant = '') => {
  fn(prev => ({
    isOpen: !prev.isOpen,
    title,
    message,
    variant
  }))
}

export default CustomAlert