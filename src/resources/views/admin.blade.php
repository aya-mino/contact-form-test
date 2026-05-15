@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<h1>Admin</h1>
<form action="/admin" method="get">

  <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">

  <select name="gender">
    <option value="">性別</option>
    <option value="1">男性</option>
    <option value="2">女性</option>
    <option value="3">その他</option>
  </select>

  <select name="category_id">
    <option value="">お問い合わせの種類</option>

    @foreach ($categories as $category)
    <option value="{{ $category['id'] }}">
      {{ $category['content'] }}
    </option>
    @endforeach

  </select>

  <input type="date" name="date">

  <button type="submit">
    検索
  </button>

  <a href="/admin">
    リセット
  </a>

  <a href="/export">
  エクスポート
  </a>
</form>
<table>
    <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th>詳細</th>
    </tr>

    @foreach ($contacts as $contact)
    <tr>
        <td>
            {{ $contact['last_name'] }}
            {{ $contact['first_name'] }}
        </td>

        <td>
            @if ($contact['gender'] == 1)
                男性
            @elseif ($contact['gender'] == 2)
                女性
            @elseif ($contact['gender'] == 3)
                その他
            @endif
        </td>

        <td>
            {{ $contact['email'] }}
        </td>

        <td>
            {{ $contact['category']['content'] }}
        </td>
        <td>
            <button type="button" onclick="openModal({{ $contact['id'] }})">
                詳細
            </button>
        </td>
    </tr>
<div class="modal" id="modal-{{ $contact['id'] }}" style="display: none;">
    <div class="modal__content">
        <p>
            {{ $contact['last_name'] }}
            {{ $contact['first_name'] }}
        </p>
        <p>{{ $contact['email'] }}</p>
        <p>{{ $contact['tel'] }}</p>
        <p>{{ $contact['address'] }}</p>
        <p>{{ $contact['building'] }}</p>
        <p>{{ $contact['category']['content'] }}</p>
        <p>{{ $contact['detail'] }}</p>
    <form action="/delete/{{ $contact['id'] }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit">
        削除
      </button>
    </form>
    <button type="button" onclick="closeModal({{ $contact['id'] }})">
        ×
    </button>
    </div>
</div>
    @endforeach

</table>
<div style="width: 300px;">
  {{ $contacts->links() }}
</div>
<form action="/logout" method="post">
    @csrf

    <button type="submit">
        logout
    </button>
</form>
<script>
function openModal(id) {
  document.getElementById('modal-' + id).style.display = 'block';
}
function closeModal(id) {
  document.getElementById('modal-' + id).style.display = 'none';
}
</script>
@endsection