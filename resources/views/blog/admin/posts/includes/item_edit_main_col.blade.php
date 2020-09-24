<div class='row justify-content-center'>
    <div class='col-md-12'>
        <div class='card'>
            <div class='card-body'>
            <div class='card-title'></div>
            <ul class='nav nav-tabs' role='tablist'>
                <li class='nav-item'>
                    <a class='nav-link active' data-toggle='tab' href='#maindata' role='tab'>Основные данные</a>
                </li>
            </ul>
            <br>
            <div class='tab-content'>
                <div class='tab-pave active' id='maindata' role='tabpanel'>
                    <div class='form-group'>
                        <label for='title'>Заголовок</label>
                        <input name='title' value='{{ $item->title }}'
                        id='title'
                        type='text'
                        class='form-control'
                        minlength='3'
                        required
                        >
                    </div>
                    <div class='form-group'>
                        <label for='slug'>Индентификатор</label>
                        <input name='slug' value='{{ $item->slug }}'
                        id='slug'
                        type='text'
                        class='form-control'
                        >
                    </div>
                    <div class='form-group'>
                    <label for='parent_id'>Родитель</label>
                    <select name='parent_id'
                    id='parent_id'
                    class='form-control'
                    placeholder='Выберите категорию'
                    required
                    >
                    @foreach($categoryList as $category)
                        <option value="{{ $category->id }}"
                         @if($category->id == $item->parent_id) selected @endif>
                        {{ $category->id_title }}
                        </option>
                    @endforeach
                    </select>
                    </div>
                    <div class='form-group'>
                        <label for='description'>Статья</label>
                        <textarea name='description'
                        id='description'
                        rows='3'
                        class='form-control'
                        >{{ old('description',$item->content_raw) }}</textarea>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
