<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Подтверждение</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body" id="confirmModalText">
            ...
        </div>
        <div class="modal-footer">
            {{-- rename --}}
            <button type="button" 
                    class="btn btn-primary" 
                    id="confirmModalOk" 
                    data-bs-toggle="modal" 
                    data-bs-target="#alertModal"
                    style="background-color: rgb(255, 100, 0); border-color: rgb(255, 100,0);"
                    data-product="">Да</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
        </div>
        </div>
    </div>
</div>