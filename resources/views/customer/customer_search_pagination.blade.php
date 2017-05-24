<div class="pagination">
            <div class="paging">
@if ($paginator->hasPages())
                @if($paginator->onFirstPage())
                    <a class="disabled btn-blue page-first">&laquo;</a>
                    <a  class="disabled btn-blue page-prev">&laquo;</a>
                @else
                    <a style="cursor:pointer" onClick="search_data(1)" class="btn-blue page-first">&laquo;</a>
                    <a style="cursor:pointer" onClick="search_data({{ $paginator->currentPage() }} - 1)" class="btn-blue page-prev">&lsaquo;</a>
                @endif

                @if($paginator->hasMorePages()) 
                    <a style="cursor:pointer" onClick="search_data({{ $paginator->currentPage() + 1 }})" class="btn-blue page-next">&rsaquo;</a>
                    <a style="cursor:pointer" onClick="search_data({{ $paginator->lastPage() }})" class="btn-blue page-last">&raquo;</a>
                @else
                    <a class="disabled btn-blue page-next">&rsaquo;</a>
                    <a class="disabled btn-blue page-last">&raquo;</a>
                @endif

                <p class="page-of">
                    <input type="text" value="{{ $paginator->currentPage() }}" id="input_page">
                    <span>&nbsp;/ <b>{{ $paginator->lastPage() }}</b>ページ</span>
                </p>
                <a style="cursor:pointer" class="btn-blue to-change" id="change_page">変更</a>
@endif
            </div>
    <div class="pages">
        <select name="paginate_count" id="paginate_count">
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100" selected="selected">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
        </select>
        <a style="cursor:pointer" class="btn-blue" id="change_page_count">変更</a>
    </div>
</div>