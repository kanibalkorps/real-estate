@props(["data" => null, "keys" => [], "entities" => null, "hasButtons" => false])

<table class="table table-bordered text-nowrap mb-0 align-middle">
    <thead class="text-dark fs-4">
    <tr>
        @foreach($keys as $key)
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{ ucfirst($key) }}</h6>
            </th>
        @endforeach
        @if($hasButtons)
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Modify</h6>
            </th>
            <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Destroy</h6>
            </th>
        @endif
    </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($keys as $key)
                    @if($key === "price")
                        <td>${{$row[$key]}}</td>
                    @elseif($key === "image")
                        <td><img class="h-auto" width="150px" src="{{asset("assets/theme/img") . '/' . $row[$key] . '.jpg'}}" alt="{{$row[$key]}}"/></td>
                    @elseif($key === "area")
                        <td>{{$row[$key]}}m²</td>
                    @else
                        <td>{{ \Illuminate\Support\Str::limit($row[$key], 50) }}</td>
                    @endif
                @endforeach
                @if($hasButtons)
                        <td>
                            <a href="{{ route("admin." . $entities . ".edit", ["id" => $row->id]) }}" class="btn bg-warning border-0 rounded-pill px-3 py-1 text-white">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.' . $entities . '.delete', ['id' => $row->id]) }}">
                                @csrf
                                <button type="submit" class="bg-danger border-0 rounded-pill px-3 py-1 text-white">Delete</button>
                            </form>
                        </td>
                    @endif
            </tr>
        @endforeach
    </tbody>
</table>
