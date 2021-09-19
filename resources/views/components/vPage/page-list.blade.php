<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<section class="py-20">
  <div class="container px-4 mx-auto">
    <div class="max-w-2xl mx-auto text-center">
      <div class="max-w-md mb-8 mx-auto">
        <span class="text-sm text-blueGray-400">Link URL</span>
        <h2 class="mt-2 text-4xl font-bold font-heading">我的網域</h2>
      </div>
      @foreach ($pageList as $page)
      <div class="mb-4">
        <label class="text-left block text-blueGray-800 text-sm font-semibold mb-2" for="">Label for text</label> 
        <div class="flex px-2 bg-blueGray-50 rounded">
          <input class="appearance-none p-4 text-xs font-semibold leading-none bg-blueGray-50 rounded outline-none" type="text" name="field-name" placeholder="{{ $page->page_url }}">
          <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}" class="ml-auto inline-block py-4 px-8 text-xs text-white text-center font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded">編輯</a> 
        </div>
      </div>

      @endforeach

     
    </div>
  </div>
</section>
    <!-- <div>
        <ul>
            @foreach ($pageList as $page)
            <li>
                {{ $page->page_url }} <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}">edit</a>
            </li>
            @endforeach
        </ul>
    </div> -->
</body>
</html>
