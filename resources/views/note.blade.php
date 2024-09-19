@php use Illuminate\Support\Facades\Crypt; @endphp
<div class="d-flex flex-column gap-4 bg-body-tertiary border border-black p-3 my-3 rounded-3">
    <div>
        <div class="d-flex justify-content-between">
            <div>
                <h5>{{ $note->title }}</h5>
                <p class="fst-italic">Criado em {{ date('d/m/Y H:i', strtotime($note->created_at)) }}</p>
            </div>
            <div>
                <a href="{{ route('note.edit', Crypt::encrypt($note->id)) }}" class="btn btn-warning">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <a href="{{ route('note.destroy', Crypt::encrypt($note->id)) }}" class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
        <hr>
        <div>
            <p>{{ $note->body }}</p>
        </div>
    </div>
</div>
