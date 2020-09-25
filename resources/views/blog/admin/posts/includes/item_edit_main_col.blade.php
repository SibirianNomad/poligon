<div class='row justify-content-center'>
    <div class='col-md-12'>
        <div class='card'>
            <div class='card-body'>
            <div class='card-title'></div>
            <ul class='nav nav-tabs' role='tablist'>
                <li class='nav-item'>
                    <a class='nav-link active' data-toggle='tab' href='#maindata' role='tab'>Основные данные</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' data-toggle='tab' href='#adddata' role='tab'>Доп. данные</a>
                </li>
            </ul>
            <br>
            <div class='tab-content'>
                <div class='tab-pane active show' id='maindata' role='tabpanel'>
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
                        <label for='content_raw'>Статья</label>
                        <textarea name='content_raw'
                        id='content_raw'
                        rows='20'
                        class='form-control'
                        >{{ old('content_raw',$item->content_raw) }}</textarea>
                    </div>
                </div>
                <div class='tab-pane' id='adddata' role='tabpanel' style="display: block">

                    <div class='form-group'>
                        <label for='slug'>Индентификатор</label>
                        <input name='slug' value='{{ $item->slug }}'
                               id='slug'
                               type='text'
                               class='form-control'
                        >
                    </div>
                    <div class='form-group'>
                        <label for='category_id'>Категория</label>
                        <select name='category_id'
                                id='category_id'
                                class='form-control'
                                placeholder='Выберите категорию'
                                required
                        >
                            @foreach($categoryList as $category)
                                <option value="{{ $category->id }}"
                                        @if($category->id == $item->category_id) selected @endif>
                                    {{ $category->id_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='except'>Выдержка</label>
                        <textarea name='except'
                                  id='except'
                                  rows='3'
                                  class='form-control'
                        >{{ old('except',$item->except) }}</textarea>
                    </div>
                    <div class="form-check">
                        <input name="is_published"
                               type="hidden"
                               value="0"
                        >
                        <input name="is_published"
                        type="checkbox"
                        class="form-check-input"
                        value="1"
                        @if($item->is_published)
                            checked="checked"
                            @endif
                        >
                        <label class="form-check-label" for="is_published">Опубликовано</label>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
