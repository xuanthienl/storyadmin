<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .pagination {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .pagination li {
        margin: 5px 5px;
        display: inline-block;
        width: ;
        /* background-color:#1598AF; */
        /* border: 3px solid #1598AF; */
        padding: 0px;
        line-height: 40px;
        font-weight: 600;
        transition: 0.3s;
        border-radius: 5px 5px 5px 5px;
        
        }
    </style>
</head>
<body>
    <!-- ĐÂY LÀ FILE CHỈNH SỬA LẠI PHẦN PHÂN TRANG (PAGINATION), CHÈN $categories->render('pagination') CHỖ CẦN PHÂN TRANG ĐẺ GỌI ĐẾN VIEW NÀY -->
    @if (isset($paginator) && $paginator->lastPage() > 1)
        <ul class="pagination ml-auto">
            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} page-item">
                <a class=" page-link " href="{{ $paginator->url($paginator->currentPage()-1) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Pre</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage() && $i <=3; $i++) 
            <!-- Hoặc $i <= $paginator->lastPage();  -->
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} page-item">
                    <a class=" page-link " href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} page-item">
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="page-link" aria-label="Next">
                    <span aria-hidden="true">Next &raquo; </span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    @endif
</body>
</html>