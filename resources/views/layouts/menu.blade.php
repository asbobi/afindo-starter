<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="menu-title">
            <span>BERANDA</span>
        </li>
        <li class="{{ request()->is("home") ? "active" : "" }}">
            <a href="{{ route("home") }}"><i class="feather-home"></i> <span>Dashboard</span></a>
        </li>

        @php
            $data_fitur = session("akses")->toArray();

            // echo json_encode($data_fitur); die;

            $arr = [];
        @endphp
        @foreach ($data_fitur as $row)
            @php
                $arr[$row->KelompokFitur][] = $row;
            @endphp
        @endforeach

        @foreach ($arr as $key => $val)
            @php
                $jumlahmenu = count($val);
            @endphp
            <li class="menu-title">
                <span>{{ strtoupper($key) }}</span>
            </li>
            @foreach ($val as $k => $v)
                @php
                    $active = strtolower(@$menu) == strtolower($v->NamaFitur) ? 'class="active"' : "";
                    $url = @$v->Slug ?? "home";
                @endphp

                <li {!! $active !!}>
                    <a href="{{ url($url) }}"><i class="{{ $v->Icon }}"></i>
                        <span>{{ $v->NamaFitur }}</span></a>
                </li>
            @endforeach
        @endforeach
    </ul>
</div>
