<?php

use Laravolt\SemanticForm\Elements\Text;

class TextTest extends \PHPUnit\Framework\TestCase
{
    public function test_can_render_basic_text()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('first_name');

        $expected = '<input type="text" name="first_name">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_with_id()
    {
        $text = new Text('email');
        $text = $text->id('email_field');

        $expected = '<input type="text" name="email" id="email_field">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('first_name');
        $text = $text->id('name_field');

        $expected = '<input type="text" name="first_name" id="name_field">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_with_value()
    {
        $text = new Text('email');
        $text = $text->value('example@example.com');

        $expected = '<input type="text" name="email" value="example@example.com">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('first_name');
        $text = $text->value('test@test.com');

        $expected = '<input type="text" name="first_name" value="test@test.com">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('first_name');
        $text = $text->value(null);

        $expected = '<input type="text" name="first_name">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_with_class()
    {
        $text = new Text('email');
        $text = $text->addClass('error');

        $expected = '<input type="text" name="email" class="error">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');
        $text = $text->addClass('success');

        $expected = '<input type="text" name="email" class="success">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_render_with_placeholder()
    {
        $text = new Text('email');
        $text = $text->placeholder('error');

        $expected = '<input type="text" name="email" placeholder="error">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');
        $text = $text->placeholder('success');

        $expected = '<input type="text" name="email" placeholder="success">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_be_cast_to_string()
    {
        $text = new Text('email');

        $expected = $text->render();
        $result = (string) $text;
        $this->assertEquals($expected, $result);
    }

    public function test_required()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" required="required">';
        $result = $text->required()->render();
        $this->assertEquals($expected, $result);
    }

    public function test_autofocus()
    {
        $text = new Text('');

        $result = $text->autofocus()->render();
        $message = 'autofocus attribute should be set';
        $this->assertStringContainsString('autofocus="autofocus"', $result, $message);
    }

    public function test_unfocus()
    {
        $pattern = 'autofocus="autofocus"';
        $text = new Text('');

        $result = $text->unfocus()->render();
        $message = 'autofocus attribute should not be set';
        $this->assertStringNotContainsString($pattern, $result, $message);

        $text = new Text('');

        $result = $text->autofocus()->unfocus()->render();
        $message = 'autofocus attribute should be removed';
        $this->assertStringNotContainsString($pattern, $result, $message);
    }

    public function test_readonly()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" readonly="readonly">';
        $result = $text->readonly()->render();
        $this->assertEquals($expected, $result);
    }

    public function test_optional()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->optional()->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->required()->optional()->render();
        $this->assertEquals($expected, $result);
    }

    public function test_disable()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" disabled="disabled">';
        $result = $text->disable()->render();
        $this->assertEquals($expected, $result);
    }

    public function test_disable_with_parameter()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->disable(false)->render();
        $this->assertEquals($expected, $result);

        $expected = '<input type="text" name="email" disabled="disabled">';
        $result = $text->disable(true)->render();
        $this->assertEquals($expected, $result);
    }

    public function test_enable()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->enable()->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');

        $expected = '<input type="text" name="email">';
        $result = $text->disable()->enable()->render();
        $this->assertEquals($expected, $result);
    }

    public function test_enable_with_parameter()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" disabled="disabled">';
        $result = $text->enable(false)->render();
        $this->assertEquals($expected, $result);
    }

    public function test_default_value()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" value="example@example.com">';
        $result = $text->defaultValue('example@example.com')->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');

        $expected = '<input type="text" name="email" value="test@test.com">';
        $result = $text->value('test@test.com')->defaultValue('example@example.com')->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');

        $expected = '<input type="text" name="email" value="test@test.com">';
        $result = $text->defaultValue('example@example.com')->value('test@test.com')->render();
        $this->assertEquals($expected, $result);
    }

    public function test_custom_attribute()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" data-sample="test-value">';
        $result = $text->attribute('data-sample', 'test-value')->render();
        $this->assertEquals($expected, $result);

        $expected = '<input type="text" name="email">';
        $result = $text->clear('data-sample')->render();
        $this->assertEquals($expected, $result);
    }

    public function test_data_attribute()
    {
        $text = new Text('email');

        $expected = '<input type="text" name="email" data-sample="test-value">';
        $result = $text->data('sample', 'test-value')->render();
        $this->assertEquals($expected, $result);

        $text = new Text('email');

        $expected = '<input type="text" name="email" data-custom="another-value">';
        $result = $text->data('custom', 'another-value')->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_remove_class()
    {
        $text = new Text('email');
        $text = $text->addClass('error');

        $expected = '<input type="text" name="email" class="error">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = $text->addClass('large');

        $expected = '<input type="text" name="email" class="error large">';
        $result = $text->render();
        $this->assertEquals($expected, $result);

        $text = $text->removeClass('error');

        $expected = '<input type="text" name="email" class="large">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_add_attributes_through_magic_methods()
    {
        $text = new Text('email');
        $text = $text->maxlength('5');

        $expected = '<input type="text" name="email" maxlength="5">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_add_attributes_through_magic_methods_with_optional_parameter()
    {
        $text = new Text('cow');
        $text = $text->moo();

        $expected = '<input type="text" name="cow" moo="moo">';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }

    public function test_can_have_label()
    {
        $text = (new Text('email'))->label('Email');

        $expected = '<div class="field"><label>Email</label><input type="text" name="email"></div>';
        $result = $text->render();
        $this->assertEquals($expected, $result);
    }
}
