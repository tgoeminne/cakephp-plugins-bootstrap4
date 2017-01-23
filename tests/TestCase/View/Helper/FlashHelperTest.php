<?php


namespace lilHermit\Bootstrap4\Test\TestCase\View\Helper;


use Cake\Core\Plugin;
use Cake\Network\Request;
use lilHermit\Bootstrap4\View\BootstrapView;
use lilHermit\Bootstrap4\View\Helper\FlashHelper;

class FlashHelperTest extends \Cake\Test\TestCase\View\Helper\FlashHelperTest {

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();

        // Save the session with all the flashes (set by parent
        $session = $this->View->request->session();

        // Use our View (Boostrap)
        $this->View = new BootstrapView();
        $this->View->request = new Request(['session' => $session]);
        $this->Flash = new FlashHelper($this->View);

        Plugin::load('lilHermit/Bootstrap4', ['path' => ROOT . DS]);
    }

    /**
     * testFlash method
     *
     * @return void
     */
    public function testFlash() {
        $result = $this->Flash->render();

        $this->assertHtml([
            ['div' => ['class' => 'alert alert-info alert-dismissible fade show', 'role' => 'alert']],
            ['button' => ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']],
            ['span' => ['aria-hidden' => 'true']],
            '&times;',
            ['/span' => true],
            ['/button' => true],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true]
        ], $result);

        $expected = '<div id="classy-message">Recorded</div>';
        $result = $this->Flash->render('classy');
        $this->assertEquals($expected, $result);

        $result = $this->Flash->render('notification');
        $expected = [
            'div' => ['id' => 'notificationLayout'],
            '<h1', 'Alert!', '/h1',
            '<h3', 'Notice!', '/h3',
            '<p', 'This is a test of the emergency broadcasting system', '/p',
            '/div'
        ];
        $this->assertHtml($expected, $result);
        $this->assertNull($this->Flash->render('non-existent'));
    }

    /**
     * Test that when rendering a stack, messages are displayed in their
     * respective element, in the order they were added in the stack
     *
     * @return void
     */
    public function testFlashWithStack() {
        $result = $this->Flash->render('stack');
        $expected = [
            ['div' => ['class' => 'alert alert-info alert-dismissible fade show', 'role' => 'alert']],
            ['button' => ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']],
            ['span' => ['aria-hidden' => 'true']],
            '&times;',
            ['/span' => true],
            ['/button' => true],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true],

            ['div' => ['id' => 'notificationLayout']],
            '<h1', 'Alert!', '/h1',
            '<h3', 'Notice!', '/h3',
            '<p', 'This is a test of the emergency broadcasting system', '/p',
            '/div',

            ['div' => ['id' => 'classy-message']], 'Recorded', '/div'
        ];
        $this->assertHtml($expected, $result);
        $this->assertNull($this->View->request->session()->read('Flash.stack'));
    }

    /**
     * Tests all bootstrap alert variants
     *
     * @return void
     */
    public function testFlashVariants() {

        $this->View->request->session()->write('Flash.flash.0.element', 'Flash/error');
        $result = $this->Flash->render();
        $this->assertHtml([
            ['div' => ['class' => 'alert alert-danger alert-dismissible fade show', 'role' => 'alert']],
            ['button' => ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']],
            ['span' => ['aria-hidden' => 'true']],
            '&times;',
            ['/span' => true],
            ['/button' => true],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true]
        ], $result);

        $this->View->request->session()->write('Flash.flash.0', [
            'key' => 'flash',
            'message' => 'This is a calling',
            'element' => 'Flash/success',
            'params' => []
        ]);
        $result = $this->Flash->render();
        $this->assertHtml([
            ['div' => ['class' => 'alert alert-success alert-dismissible fade show', 'role' => 'alert']],
            ['button' => ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']],
            ['span' => ['aria-hidden' => 'true']],
            '&times;',
            ['/span' => true],
            ['/button' => true],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true]
        ], $result);

        $this->View->request->session()->write('Flash.flash.0', [
            'key' => 'flash',
            'message' => 'This is a calling',
            'element' => 'Flash/warning',
            'params' => []
        ]);
        $result = $this->Flash->render();
        $this->assertHtml([
            ['div' => ['class' => 'alert alert-warning alert-dismissible fade show', 'role' => 'alert']],
            ['button' => ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']],
            ['span' => ['aria-hidden' => 'true']],
            '&times;',
            ['/span' => true],
            ['/button' => true],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true]
        ], $result);
    }

    /**
     * Tests the no-dismiss param
     *
     * @return void
     */
    public function testFlashNoDismiss() {

        $this->View->request->session()->write('Flash.flash.0.params', ['noDismiss' => true]);
        $result = $this->Flash->render();
        $this->assertHtml([
            ['div' => ['class' => 'alert alert-info alert-dismissible fade show', 'role' => 'alert']],
            'preg:/[\s]*This is a calling[\s]*/',
            ['/div' => true]
        ], $result);
    }
}