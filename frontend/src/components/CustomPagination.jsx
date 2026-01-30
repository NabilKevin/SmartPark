import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationLink,
  PaginationNext,
  PaginationPrevious,
} from "@/components/ui/pagination"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

const CustomPagination = ({page, handleChangePage, totalPage, handleChange, perPage, setPerPage, theme = 'dark'}) => {
  return (
    <div className={`${theme === 'light' ? 'bg-foreground' : 'bg-slate-900/50'} border border-indigo-900/30 rounded-xl p-4 backdrop-blur-sm flex gap-5 items-center justify-center`}>
      <Pagination>
        <PaginationContent>
          <PaginationItem>
            <PaginationPrevious className={`${page === 1 ? "pointer-events-none opacity-50" : ""} ${theme === 'light' ? 'text-black font-medium' : 'text-white'} text-md`} onClick={() => handleChangePage(page === 1 ? 1 : page - 1)} />
          </PaginationItem>
          
          {
            page - 2 > 1 && (
              <PaginationItem>
                <PaginationEllipsis />
              </PaginationItem>
            )
          }
          {
            [...Array(totalPage <= 3 ? totalPage : 3)].map((_, i) => (
              <PaginationItem key={i}>
                <PaginationLink className={`${theme === 'light' ? 'text-black font-medium bg-foreground' : 'text-white'} text-md`} onClick={() => handleChangePage(i + page - (page === 1 ? 0 : page === totalPage && totalPage >= 3 ? 2 : 1))} isActive={page === (i + page - (page === 1 ? 0 : page === totalPage && totalPage >= 3 ? 2 : 1))}>{i + page - (page === 1 ? 0 : page === totalPage && totalPage >= 3 ? 2 : 1)}</PaginationLink>
              </PaginationItem>
            ))
          }
          {
            page + 2 < totalPage && (
              <PaginationItem>
                <PaginationEllipsis />
              </PaginationItem>
            )
          }
          
          <PaginationItem>
            <PaginationNext className={`${page === totalPage ? "pointer-events-none opacity-50" : ""} ${theme === 'light' ? 'text-black font-medium' : 'text-white'} text-md`} onClick={() => handleChangePage(page === totalPage ? totalPage : page + 1)} />
          </PaginationItem>
        </PaginationContent>
      </Pagination>

      <div className="flex items-center gap-4">
        <span className={`text-md ${theme === 'light' ? 'text-black font-medium' : 'text-white'} whitespace-nowrap`}>
          Rows per page
        </span>

        <Select value={perPage} onValueChange={e => handleChange(setPerPage, e)}>
          <SelectTrigger className={`w-20 ${theme === 'light' ? 'text-black font-medium' : 'text-white'} text-md`}>
            <SelectValue />
          </SelectTrigger>
          <SelectContent className={`${theme === 'light' ? 'text-black font-medium' : 'text-white'} bg-foreground text-md`}>
            <SelectItem value="10">10</SelectItem>
            <SelectItem value="25">25</SelectItem>
            <SelectItem value="50">50</SelectItem>
            <SelectItem value="100">100</SelectItem>
          </SelectContent>
        </Select>
      </div>


    </div>
  )
}

export const handleChangePage = ({destinationPage, loading, page, setLoading, setPage}) => {
    if(!loading && destinationPage !== page) {
      setLoading(true)
      setPage(destinationPage)
    }
  }

export default CustomPagination
