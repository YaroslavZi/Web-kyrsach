@include('header')

<div class="content mt-5 mb-5 radius-content py-3 px-3" style="min-height: 300px; min-width: 80%;">

    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($columns as $col)
                <th scope="col">
                    {{ $col }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($query as $item)
            <tr>
                @foreach ($item as $el)

                <td>{{ $el }}</td>
                @endforeach

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
            {{ $query->links() }}
        </div>
</div>

@include('footer')
