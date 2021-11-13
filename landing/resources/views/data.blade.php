@extends('layouts.app')

@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="table-responsive p-3">
                <table  class="table">
                <thead>
                    <tr>
                        <th scope="col">URL</th>
                        <th scope="col">Количество визитов</th>
                        <th scope="col">Последнее посещение</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas['data'] as $data)
                    <tr>
                        <td>{{ $data['url'] }}</td>
                        <td>{{ $data['count'] }}</td>
                        <td>{{ date_format(date_create($data['visited_at']),'Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div>
                @foreach($datas['links'] as $link)
                    <a {{ $link['url'] ? 'href='.$link['url']:'' }} >
                    <span class="p-1 border border-dark {{ $link['active'] ? 'font-weight-bold':'' }}">{{ html_entity_decode($link['label']) }}</span>
                    </a>
                @endforeach
                Всего записей {{ $datas['total'] }}
            </div>
          </div>
        </div>
      </div>
      <!--Row-->
  
    </div>
@endsection