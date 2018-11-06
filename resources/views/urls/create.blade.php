@extends('layouts.app')

@section('content')
    <div class="mdui-center mdui-text-color-grey-800 mdui-text-center" style="float: left;width:100%;font-size: 35px;">
        短网址
    </div>
    <div class="mdui-center mdui-m-t-3" style="width: 100%;float: left">
        <div class="mdui-textfield">
            <textarea name="url" class="mdui-textfield-input" rows="4" placeholder="请输入网址..."></textarea>
        </div>
        <button class="mdui-ripple mdui-color-pink-400 mdui-btn mdui-btn-raised  mdui-center mdui-m-t-3" type="submit"
                value="提交">
            提交
        </button>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('statics/js/clipboard.min.js') }}"></script>
    <script type="text/javascript">
        var $ = mdui.JQ;

        $('textarea').get(0).focus();

        $(document).on('keyup', (event) => {
            if (event.keyCode == "13") {
                $('button').trigger('click');
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('button').on('click', () => {
            var _this = $(this);
            var url = $("textarea[name='url']").val();
            if (url == '' || url == null) {
                mdui.snackbar('链接不能为空！');
                return;
            }

            _this.prop('disabled', 'disabled');

            $.ajax({
                method: 'POST',
                dataType: 'json',
                data: {url: url},
                url: '{{ route('urls.store') }}',
                complete: () => {
                    _this.removeAttr('disabled');
                },
                success: (response) => {
                    if (response.code != 0) {
                        mdui.snackbar('生成失败！');
                        return;
                    }
                    showDialog(response.content.short_url);
                },
                error: (response) => {
                    mdui.snackbar('发生错误！');
                }
            });
        });

        function showDialog(short_url) {
            mdui.dialog({
                title: '',
                content:
                    '<div class="mdui-typo">' +
                    '<div class="mdui-m-t-2 mdui-m-b-1 mdui-text-center">' +
                    '<label class="mdui-text-color-black-secondary">短链接： </label>' +
                    '<code class="js-icon-code-copy" data-clipboard-text=\'' + short_url + '\' mdui-tooltip="{content: \'点击复制\'}">' +
                    short_url +
                    '</code>' +
                    '</div>' +
                    '</div>',
                onOpen: () => {
                    clipboard = new Clipboard('.js-icon-code-copy');
                    clipboard.on('success', function (e) {
                        mdui.snackbar('复制成功');
                        e.clearSelection();
                    });
                    clipboard.on('error', function (e) {
                        mdui.snackbar('复制失败，请手动复制');
                    });
                },
                onClosed: () => {
                    clipboard.destroy();
                }
            });
        }
    </script>
@endsection