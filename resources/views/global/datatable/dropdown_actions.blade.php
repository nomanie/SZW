<div class="w-100 cursor-pointer dropdown-action">
    <div class="w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </div>
    @if($type === 0)
    <ul class="dropdown-menu">
        <li class="dt-ajax" data-type="show" data-id="{{$row->id}}">
            <i class="fa fa-circle-info"></i>
            Szczegóły
        </li>
        <li class="dt-ajax" data-type="edit" data-id="{{$row->id}}">
            <i class="fa fa-pencil"></i>
            Edytuj
        </li>
        <li class="dt-ajax" data-type="delete" data-id="{{$row->id}}">
            <i class="fa fa-trash"></i>
            Usuń
        </li>
    </ul>
    @elseif($type === 1)
        <ul class="dropdown-menu">
            <li class="dt-ajax" data-type="restore" data-id="{{$row->id}}">
                <i class="fa fa-pencil"></i>
                Przywróć
            </li>
            <li class="dt-ajax" data-type="delete" data-id="{{$row->id}}">
                <i class="fa fa-trash"></i>
                Usuń całkowicie
            </li>
        </ul>
    @endif
</div>
