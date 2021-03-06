Form
####

.. php:namespace:: LilHermit\Bootstrap4\View\Helper

.. php:class:: FormHelper(View $view, array $config = [])


The ``FormHelper`` builds upon the CakePHP core ``FormHelper`` and transparently
styles form elements. As standard it renders Bootstrap4
`custom form <https://v4-alpha.getbootstrap.com/components/forms/#custom-forms>`_ elements
where relevant, however this can be disabled.

You use the methods of ``FormHelper`` as you would normally do and the output will get styled
correctly.

Form Layouts
============

The plugin supports all the form 'layout' styles that Bootstrap supports, ``block`` (default), ``inline`` and ``grid``

.. _block-layout:

Block Layout
------------

This is the default layout where the labels are positioned above the control::

    echo $this->Form->control('Name', [
            'placeholder' => 'Jane Doe'
    ]);
    echo $this->Form->control('username', [
            'placeholder' => 'Username',
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group">
            <label class="col-form-label" for="name">Name</label>
            <input type="text" name="Name" placeholder="Jane Doe" id="name" class="form-control"/>
        </div><div class="form-group">  <label class="col-form-label" for="username">Username</label>
            <input type="text" name="username" placeholder="Username" id="username" class="form-control"/>
        </div>
    </div>

.. _inline-layout:

Inline Layout
-------------

You indicate inline layout via the `layout -> type` option being set to ``inline`` when
creating the form as below. Inline layout will render with all controls on the same line::

    echo $this->Form->create(null, [
            'layout' => ['type' => 'inline']
    ]);

    echo $this->Form->control('Name', [
            'class' => ['mb-2', 'mx-sm-2', 'mb-sm-0'],
            'placeholder' => 'Jane Doe'
    ]);

    echo $this->Form->control('username', [
            'class' => ['mb-2', 'mx-sm-2', 'mb-sm-0'],
            'placeholder' => 'Username',
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <form method="post" accept-charset="utf-8" class="form-inline" action="/"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><label class="col-form-label" for="name">Name</label><input type="text" name="Name" class="mb-2 mx-sm-2 mb-sm-0 form-control" placeholder="Jane Doe" id="name"/><label class="col-form-label" for="username">Username</label><input type="text" name="username" placeholder="Username" class="mb-2 mx-sm-2 mb-sm-0 form-control" id="username"/></form>
    </div>

You can also hide the labels and just rely on the placeholder with the ``showLabels`` in `options` on create::

    echo $this->Form->create(null, [
            'layout' => ['type' => 'inline', 'showLabels' => false]
    ]);

    echo $this->Form->control('Name', [
            'class' => ['mb-2', 'mx-sm-2', 'mb-sm-0'],
            'placeholder' => 'Jane Doe'
    ]);

    echo $this->Form->control('username', [
            'class' => ['mb-2', 'mx-sm-2', 'mb-sm-0'],
            'placeholder' => 'Username',
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <form method="post" accept-charset="utf-8" class="form-inline" action="/"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><label class="sr-only" for="name">Name</label><input type="text" name="Name" class="mb-2 mx-sm-2 mb-sm-0 form-control" placeholder="Jane Doe" id="name"/><label class="sr-only" for="username">Username</label><input type="text" name="username" placeholder="Username" class="mb-2 mx-sm-2 mb-sm-0 form-control" id="username"/></form>
    </div>

.. _grid-layout:

Grid Layout
-----------

You indicate grid layout the same way as inline by setting the `layout -> type` option being set to ``grid`` when
creating the form as below. The default column layout will be `col-sm-2` and `col-sm-10` (this can be changed as detailed below)::

    echo $this->Form->create(null, [
        'layout' => [
            'type' => 'grid',
            'classes' => [
                'submitContainer' => ['col-sm-10', 'offset-sm-2', 'p-1']
            ]
        ]
    ]);

    echo $this->Form->control('Name', [
        'placeholder' => 'Jane Doe'
    ]);

    echo $this->Form->control('username', [
        'placeholder' => 'Username',
    ]);

    echo $this->Form->submit();
    echo $this->Form->end();

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <form method="post" accept-charset="utf-8" class="container" action="/"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><div class="form-group row"><label class="col-form-label col-sm-2" for="name">Name</label><div class="col-sm-10"><input type="text" name="Name" placeholder="Jane Doe" id="name" class="form-control"/></div></div><div class="form-group row"><label class="col-form-label col-sm-2" for="username">Username</label><div class="col-sm-10"><input type="text" name="username" placeholder="Username" id="username" class="form-control"/></div></div><div class="col-sm-10 offset-sm-2 p-1"><input type="submit" class="btn btn-primary" value="Submit"/></div></form>
    </div>

.. note:: Notice how we are passing `'classes' => [ 'submitContainer' => ['col-sm-10', 'offset-sm-2', 'p-1']]` into the create method? This allows us to position the submit button into the second column

You can change the column configuration applied to the grid using the following `grid` element::

        echo $this->Form->create(null, [
            'layout' => [
                'type' => 'grid',
                'classes' => [
                    'submitContainer' => ['col-sm-9', 'offset-sm-3', 'p-1'],
                    'grid' => [['col-sm-3'], ['col-sm-9']]
                ]
            ]
        ]);

        echo $this->Form->control('Name', [
            'placeholder' => 'Jane Doe'
        ]);

        echo $this->Form->control('username', [
            'placeholder' => 'Username',
        ]);

        echo $this->Form->submit();
        echo $this->Form->end();

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <form method="post" accept-charset="utf-8" class="container" action="/"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><div class="form-group row"><label class="col-form-label col-sm-3" for="name">Name</label><div class="col-sm-9"><input type="text" name="Name" placeholder="Jane Doe" id="name" class="form-control"/></div></div><div class="form-group row"><label class="col-form-label col-sm-3" for="username">Username</label><div class="col-sm-9"><input type="text" name="username" placeholder="Username" id="username" class="form-control"/></div></div><div class="col-sm-9 offset-sm-3 p-1"><input type="submit" class="btn btn-primary" value="Submit"/></div></form>
    </div>

.. _layout-classes:

Layout classes
--------------

In the last example we introduced the layout classes element, this allows up to style elements of the layout as well as
save time when setting the same classes on all labels and controls. For example the first inline example has `['mb-2', 'mx-sm-2', 'mb-sm-0']`
on all control method calls, this can now be eliminated now with the following::

        echo $this->Form->create(null, [
            'layout' => [
                'type' => 'inline',
                'classes' => [
                    'control' => ['mb-2', 'mx-sm-2', 'mb-sm-0']
                ]
            ]
        ]);

        echo $this->Form->control('Name', [
            'placeholder' => 'Jane Doe'
        ]);

        echo $this->Form->control('username', [
            'placeholder' => 'Username',
        ]);

Supported elements for ``classes`` are ``control``, ``label``, ``grid``, ``submitContainer``, ``radioContainer`` & ``checkboxContainer``

Creating Textual Controls
=========================

.. php:method:: control(string $fieldName, array $options = [])

.. note:: This plugin uses the **NEW** CakePHP 3.4.x `control <https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-form-controls>`_
    method however this is automatically translated to ``input`` if you are using an other version

Many additional `$options` are now supported by the ``control()`` method which provide
the following functionality:

    - Placeholder text
    - Help text
    - Prefix and Suffix

Placeholder and Help Text
-------------------------

Placeholder text is presented as hint before any text is entered into the form control whereas help
is rendered underneath the control::

    echo $this->Form->control('email', [
        'placeholder' => 'Your email address',
        'help' => 'Please enter a valid email address'
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
    <div class="form-group">
        <label class="col-form-label" for="email">Email</label>
        <input type="email" name="email" placeholder="Your email address" id="email" class="form-control"/>
        <small class="form-text text-muted">Please enter a valid email address</small>
    </div>
    </div>

Prepend/Append
--------------

The prepend/append functionality utilises Bootstrap `input-groups` to add text/buttons either side
of a textual `input`.

.. versionadded:: 4.0.0.2300 prior Prepend/Append was called Prefix/suffix

Standard (text)
_________________
::

    echo $this->Form->control('donation', [
        'prepend' => '£',
        'append' => '.00',
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label" for="donation">Donation</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">£</span></div><input type="text" name="donation" id="donation" class="form-control"/><div class="input-group-append"><span class="input-group-text">.00</span></div></div></div>
    </div>

Buttons
_______

As standard you will get `static` text elements but you can enhance the output by passing an array
for ``prepend``/``append`` and use the ``type`` option to specify a button::

        $button = $this->Html->button('Go', null, [
            'type' => 'button'
        ]);

        echo $this->Form->control('search', [
            'placeholder' => 'Search for...',
            'label' => false,
            'append' => [
                'text' => $button,
                'escape' => false,

                // Also 'type' can be 'btn' both are accepted
                'type' => 'button'
            ]
        ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><div class="input-group"><input type="text" name="search" placeholder="Search for..." id="search" class="form-control"/><div class="input-group-append"><button type="button" class="btn btn-primary">Go</button></div></div></div>
    </div>

.. note::

    You need to use ``'escape' => false`` to stop the button html from being escaped

Attributes
__________

You can also pass attributes to the ``prepend``/``append`` using the array described above such as ``class``::

    echo $this->Form->control('name', [
        'append' => [
            'text' => '<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>',
            'class' => ['bg-danger', 'text-white'],
            'escape' => false
        ]
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label" for="name">Name</label><div class="input-group"><input type="text" name="name" id="name" class="form-control"/><div class="input-group-append"><span class="bg-danger text-white input-group-text"><i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i></span></div></div></div>
    </div>

.. note::

    This example uses `fontawesome <http://fontawesome.io>`_ to add icons

Container Attributes
____________________

You can also pass attributes to the container of the ``prepend``/``append`` using the ``container`` key::

    echo $this->Form->control('name', [
        'append' => [
            'text' => 'Go',
            'class' => ['bg-info', 'text-white'],
            'container' => [ 'class' => 'bg-primary p-3' ]
        ]
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label" for="name">Name</label><div class="bg-primary p-3 input-group"><input type="text" name="name" id="name" class="form-control"/><div class="input-group-append"><span class="bg-info text-white input-group-text">Go</span></div></div></div>
    </div>

.. versionadded:: 2.1.6.6 Container attributes

Multiple
________

You can have a combination of multiple ``Prefix``/``Suffix`` by using a nested array::

    echo $this->Form->control('Donation', [

        // Array of strings
        'prepend' => ['£', '$'],

        // Array of arrays allowing for 'class' being passed and ofcourse 'type'
        // if required
        'append' => [
            [ 'text' => '.00'],
            [ 'text' => 'Go', 'class' => 'bg-info']
        ]
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label" for="donation">Donation</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">£</span><span class="input-group-text">$</span></div><input type="text" name="Donation" id="donation" class="form-control"/><div class="input-group-append"><span class="input-group-text">.00</span><span class="bg-info input-group-text">Go</span></div></div></div>
    </div>

Sizing
______

You also have a choice of small or large size by passing ``'size' => 'large'`` or ``'size' => 'small'``

Supported values are ``large``, ``lg``, ``small`` and ``sm``. You can also use size ``normal`` or ``standard`` however these are default::

    echo $this->Form->control('Donation', [
        'prepend' => ['text' => '£', 'size' => 'normal'],

        'append' => ['text' => 'Go', 'size' => 'large']
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label" for="donation">Donation</label><div class="input-group input-group-lg"><div class="input-group-prepend"><span class="input-group-text">£</span></div><input type="text" name="Donation" id="donation" class="form-control"/><div class="input-group-append"><span class="input-group-text">Go</span></div></div></div>
    </div>

.. note::

    The largest size takes precedence over 'normal' `prepend` here

.. versionadded:: 4.0.0.2300 Small size was added

Datetime elements
=================

HTML5 Datetime
--------------

This plugin overrides CakePHPs default rendering of datetime elements and renders using HTML5
builtin date/time functionality, as follows:

.. raw:: html

    <div class="form-group"><label class="col-form-label" for="date">HTML5 Style Datetime</label><input type="datetime-local" name="date" class="form-control" id="date" class="form-control"/></div>

If you prefer the CakePHP default of multiple ``select`` controls you can achieve this with
the following option with, either at Form creation time::

    echo $this->Form->create($registerUserForm, ['html5Render' => false]);

.. versionadded:: 2.1.6.5 Setting at Form creation time

or per control::

    echo $this->Form->control('CakePHPStyleDatetime', ['html5Render' => false]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label">CakePHP Style Datetime</label><div class="form-inline"><select name="select1[year]" class="form-control"><option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017" selected="selected">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option></select> <select name="select1[month]" class="form-control"><option value="01">January</option><option value="02">February</option><option value="03" selected="selected">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select> <select name="select1[day]" class="form-control"><option value="01">1</option><option value="02">2</option><option value="03" selected="selected">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> <select name="select1[hour]" class="form-control"><option value="00">0</option><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21" selected="selected">21</option><option value="22">22</option><option value="23">23</option></select> <select name="select1[minute]" class="form-control"><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21" selected="selected">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>  </div></div>
    </div>

.. note::

    A browser capable of render HTML5 datetime elements is required. Support is available in Chrome 49+,
    Opera 43+, MS Edge, Android browser + iOS Safari 7.1+ (Partial). For more information
    `check here <http://caniuse.com/#feat=input-datetime>`_

Validation
----------

If you want perform validation on HTML5 datetime elements then the standard dateTime Validator will fail.
Therefore you need to use ``Html5DateTimeBehavior`` as follows in your ``Tables`` ::

    namespace App\Model\Table;

    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    use Cake\Validation\RulesProvider;

    class MyTable extends Table {

        public function initialize(array $config)
        {
            $this->addBehavior('LilHermit/Bootstrap4.Html5DateTime');
        }
    }

.. versionadded:: 2.1.6.5 (Previously you need to add the provider manually)

Then add the rule as below to your ``validationDefault`` method::

    public function validationDefault(Validator $validator) {

        // Use the plugin provider for the `expiry` field
        $validator
            ->add('expiry',  'custom', [
                'rule' => 'dateTime',
                'provider' => 'bootstrap4',
        ]);
    }


Disabling HTML5 datetime parsing
--------------------------------

By default the plugin automatically parses the html5 date format of `2014-12-31T23:59` as well as standard
CakePHP datetime. You can to disable this by adding the following to your app config array::

    return [

            // ... other config

            'lilHermit-plugin-bootstrap4' => [
                 'disable-html5-datetime-type' => true
            ]
        ];

.. note::

    This Type parsing is backwards compatible so it is unlikely you will need to disable

Custom Form Controls
====================

Bootstrap4 introduces the concept of `custom form controls <https://v4-alpha.getbootstrap.com/components/forms/#custom-forms>`_
and by default this plugin automatically renders certain controls as custom.

The plugin supports the following custom form controls

- Checkboxes
- Radios
- File browser


Here is an example of custom `checkbox` and `radio`:

.. raw:: html

    <div class="bootstrap-example">
        <div class="custom-control custom-checkbox"><input type="hidden" name="terms_agreed" value="0"/><input type="checkbox" name="terms_agreed" value="1" id="terms-agreed" checked="checked" class="custom-control-input"><label class="custom-control-label" for="terms-agreed">I agree to the terms of use</label></div>

        <div class="form-group mt-3"><label for="gender" class="col-form-label">Gender</label><input type="hidden" name="gender" value=""/><div class="custom-control custom-radio"><input type="radio" name="gender" value="male" id="gender-male" checked="checked" class="custom-control-input"><label class="custom-control-label selected" for="gender-male">Male</label></div><div class="custom-control custom-radio"><input type="radio" name="gender" value="female" id="gender-female" class="custom-control-input"><label class="custom-control-label" for="gender-female">Female</label></div></div>
    </div>

Disabling Custom Controls
-------------------------

To disable this and revert to standard `checkboxes`/`radios` add the following option, either at Form creation time::

    echo $this->Form->create($registerUserForm, ['customControls' => false]);

or per input::

    echo $this->Form->control('terms_agreed', [
      'label' => 'I agree to the terms of use',
      'type' => 'checkbox',
      'customControls' => false
    ]);

Creating Custom Checkboxes
--------------------------

Single
______

You can create checkboxes via the ``control`` method::

    // If 'communications_opt_in' is boolean type
    echo $this->Form->control('communications_opt_in', [
      'label' => 'Please send me promotional emails',
    ]);

    // Or force to 'checkbox'
    echo $this->Form->control('terms_agreed', [
      'label' => 'I agree to the terms of use',
      'type' => 'checkbox'
    ]);

Will output

.. raw:: html

    <div class="bootstrap-example">
        <div class="custom-control custom-checkbox"><input type="hidden" name="communications_opt_in" value="0"/><input type="checkbox" name="communications_opt_in" value="1" id="communications-opt-in" class="custom-control-input"><label class="custom-control-label" for="communications-opt-in">Please send me promotional emails</label></div>

        <div class="custom-control custom-checkbox"><input type="hidden" name="terms_agreed2" value="0"/><input type="checkbox" name="terms_agreed2" value="1" id="terms-agreed2" class="custom-control-input"><label class="custom-control-label" for="terms-agreed2">I agree to the terms of use</label></div>
    </div>

Multiple
________

You can create multiple checkboxes via the ``control`` method::

    echo $this->Form->control('checkbox1', [
      'label' => 'My checkboxes',
      'default' => 2,
      'multiple' => 'checkbox',
      'type' => 'select',
      'options' => [
        ['text' => 'First Checkbox', 'value' => 1],
        ['text' => 'Second Checkbox', 'value' => 2]
      ]
    ]);

Or via the ``multiCheckbox`` method which just creates the checkboxes so you need to add your container and labels separately::

    echo $this->Html->tag('div', null, ['class' => 'form-group']);
    echo $this->Form->label('My checkboxes');

    echo $this->Form->multiCheckbox('checkbox2', [
        ['text' => 'First Checkbox', 'value' => 1],
        ['text' => 'Second Checkbox', 'value' => 2]],
        [
            'default' => 2
        ]);
    echo $this->Html->tag('/div');

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label for="checkbox1">My checkboxes</label><input type="hidden" name="checkbox1" value=""/><div class="custom-control custom-checkbox"><input type="checkbox" name="checkbox1[]" value="1" id="checkbox1-1" class="custom-control-input"><label for="checkbox1-1" class="custom-control-label">First Checkbox</label></div><div class="custom-control custom-checkbox"><input type="checkbox" name="checkbox1[]" value="2" checked="checked" id="checkbox1-2" class="custom-control-input"><label for="checkbox1-2" class="custom-control-label selected">Second Checkbox</label></div></div>
    </div>

Creating Custom Radios
----------------------

You can create radio controls via the ``control`` method as you would normally do, however just like ``multiCheckbox``
you need to add container and label::

    echo $this->Html->tag('div', null, ['class' => 'form-group']);
    echo $this->Form->label('Favourite colour');

    echo $this->Form->radio('favourite_colour', [
        ['text' => 'Red', 'value' => 'red'],
        ['text' => 'Blue', 'value' => 'blue'],
        ['text' => 'Green', 'value' => 'green'],
        ['text' => 'Orange', 'value' => 'orange'],
        ['text' => 'Purple', 'value' => 'purple']],
        ['default' => 'blue']);
    echo $this->Html->tag('/div');

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label for="favourite-colour">Favourite Colour</label><input type="hidden" name="favourite_colour" value=""/><div class="custom-control custom-radio"><input type="radio" name="favourite_colour" value="red" id="favourite-colour-red" class="custom-control-input"><label class="custom-control-label" for="favourite-colour-red">Red</label></div><div class="custom-control custom-radio"><input type="radio" name="favourite_colour" value="blue" id="favourite-colour-blue" checked="checked" class="custom-control-input"><label class="custom-control-label selected" for="favourite-colour-blue">Blue</label></div><div class="custom-control custom-radio"><input type="radio" name="favourite_colour" value="green" id="favourite-colour-green" class="custom-control-input"><label class="custom-control-label" for="favourite-colour-green">Green</label></div><div class="custom-control custom-radio"><input type="radio" name="favourite_colour" value="orange" id="favourite-colour-orange" class="custom-control-input"><label class="custom-control-label" for="favourite-colour-orange">Orange</label></div><div class="custom-control custom-radio"><input type="radio" name="favourite_colour" value="purple" id="favourite-colour-purple" class="custom-control-input"><label class="custom-control-label" for="favourite-colour-purple">Purple</label></div></div>
    </div>

Creating Custom File Browser
----------------------------

Custom File Browser control is a vast improvement on the standard HTML control below

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group">
            <label for="profileImage">Profile Image</label>
            <input type="file" class="form-control-file" id="profileImage">
            <small class="form-text text-muted">Your profile image will be visible on forum posts</small>
        </div>
    </div>

To render a custom File Browser control create a file as you normally would::

    echo $this->Form->control('ProfileImage', [
        'help' => 'Your profile image will be visible on forum posts',
        'type' => 'file'
    ]);

Will render like

.. raw:: html

    <div class="bootstrap-example">
        <div class="form-group"><label class="col-form-label d-block" for="profileimage">Profile Image</label><div class="custom-file"><input type="file" name="ProfileImage" id="profileimage" class="custom-file-input"><label class="custom-file-label">Choose file</label></div><small class="form-text text-muted">Your profile image will be visible on forum posts</small></div>
    </div>



.. meta::
    :title: Form
    :description: The Bootstrap Form extends the core Form
    :keywords: formhelper, form, helper