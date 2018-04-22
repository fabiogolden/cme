<div class="form-group">      
    <div class="row">
        <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $input['field'] = isset($input['field']) ? $input['field'] : '';
                $input['inputSize'] = isset($input['inputSize']) ? $input['inputSize'] : '12';
                $input['inputValue'] = isset($input['inputValue']) ? $input['inputValue'] : null;
                $input['css'] = isset($input['css']) ? $input['css'] : '';
                $input['disabled'] = isset($input['disabled']) ? $input['disabled'] : false;
                $input['name'] = isset($input['name']) ? $input['name'] : $input['field'];
                $input['id'] = isset($input['id']) ? $input['id'] : $input['field'];
                $input['displayField'] = isset($input['displayField']) ? $input['displayField'] : $input['field'];
                $input['keyField'] = isset($input['keyField']) ? $input['keyField'] : $input['field'];
                $input['indexSelected'] = isset($input['indexSelected']) ? $input['indexSelected'] : false;
                $input['liveSearch'] = isset($input['liveSearch']) ? $input['liveSearch'] : false;
                $input['rows'] = isset($input['rows']) ? $input['rows'] : 5;
                $input['defaultNone'] = isset($input['defaultNone']) ? $input['defaultNone'] : false;
                $input['sideBySide'] = isset($input['sideBySide']) ? $input['sideBySide'] : false;
                $input['dateTimeFormat'] = isset($input['dateTimeFormat']) ? $input['dateTimeFormat'] : false;
                $input['numMin'] = isset($input['numMin']) ? $input['numMin'] : null;
                $input['numMax'] = isset($input['numMax']) ? $input['numMax'] : null;
                $input['numStep'] = isset($input['numStep']) ? $input['numStep'] : null;
                $input['radioButtons'] = isset($input['radioButtons']) ? $input['radioButtons'] : [];
                $input['defaultValue'] = isset($input['defaultValue']) ? $input['defaultValue'] : false;
                $input['picker_begin'] = isset($input['picker_begin']) ? $input['picker_begin'] : false;
                $input['picker_end'] = isset($input['picker_end']) ? $input['picker_end'] : false;
            ?>
            <?php if($input['type'] == 'text'): ?>
                <?php $__env->startComponent('components.input-text', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'file'): ?>
                <?php $__env->startComponent('components.input-file', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'textarea'): ?>
                <?php $__env->startComponent('components.input-textarea', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'rows' => $input['rows']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'password'): ?>
                <?php $__env->startComponent('components.input-password', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'datetime'): ?>
                <?php $__env->startComponent('components.input-datetime', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'sideBySide' => $input['sideBySide'],
                    'dateTimeFormat' => $input['dateTimeFormat'],
                    'picker_begin' => $input['picker_begin'],
                    'picker_end' => $input['picker_end'],
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'select'): ?>
                <?php $__env->startComponent('components.input-select', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'items' => $input['items'],
                    'displayField' => $input['displayField'],
                    'keyField' => $input['keyField'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'inputValue' => $input['inputValue'],
                    'indexSelected' => $input['indexSelected'],
                    'liveSearch' => $input['liveSearch'],
                    'defaultNone' => $input['defaultNone']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'number'): ?>
                <?php $__env->startComponent('components.input-number', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'numMin' => $input['numMin'],
                    'numMax' => $input['numMax'],
                    'numStep' => $input['numStep']
                ]); ?>    
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            <?php if($input['type'] == 'btn-group'): ?>
                <?php $__env->startComponent('components.input-btn-group', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'radioButtons' => $input['radioButtons'],
                    'defaultValue' => $input['defaultValue']
                ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>