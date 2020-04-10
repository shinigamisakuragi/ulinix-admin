<div class="layuimini-main">
    <form class="layui-form layuimini-form" method="post" action="{{ route('admin.admins.update', ['id' => $admin->id]) }}">
        <div class="layui-form-item">
            <label class="layui-form-label required">{{ __('admin.name') }}</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.name')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.name')]) }}" value="{{ $admin->name }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.email') }}</label>
            <div class="layui-input-block">
                <input type="email" name="email" lay-verify="required|email" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.email')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.email')]) }}" value="{{ $admin->email }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{ __('admin.password') }}</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" lay-reqtext="{{ __('validation.required', ['attribute' => __('admin.password')]) }}" placeholder="{{ __('validation.placeholder', ['attribute' => __('admin.password')]) }}" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="save">{{ __('admin.form.submit') }}</button>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'table'], function () {
        var form = layui.form,
            layer = layui.layer,
            table = layui.table,
            $ = layui.$;

        /**
         * 初始化表单，要加上，不然刷新部分组件可能会不加载
         */
        form.render();

        // 当前弹出层，防止ID被覆盖
        var parentIndex = layer.index;

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            var index = layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            }, function () {

                // 关闭弹出层
                layer.close(index);
                layer.close(parentIndex);

            });


            return false;
        });

        form.on('submit(save)', function(data){
            $.post(data.form.action, data.field, res => {
                layer.msg('@lang('admin.form.success')', {icon: 1});
                window.location.reload()
            }).fail(res => {
                layer.msg('@lang('admin.form.error')', {icon: 2});

                console.log(res)
            });
            return false;
        });

    });
</script>