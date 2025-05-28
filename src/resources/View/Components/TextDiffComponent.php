<?php

namespace Juanrube\TextDiff\View\Components;

use Illuminate\View\Component;
use Juanrube\TextDiff\Facades\TextDiff;

class TextDiffComponent extends Component
{
    public $oldText;
    public $newText;
    public $renderer;
    public $options;

    /**
     * Create a new component instance.
     * 
     * @param string $oldText The original text.
     * @param string $newText The modified text.
     * @param string|null $renderer The diff renderer to use.
     * @param array $options Additional options for the diff generation.
     */
    public function __construct($oldText, $newText, $renderer = null, $options = [])
    {
        $this->oldText = $oldText;
        $this->newText = $newText;
        $this->renderer = $renderer;
        $this->options = $options;
    }

    public function render()
    {
        $diffHtml = TextDiff::generateDiff($this->oldText, $this->newText, $this->renderer, $this->options);

        return view('textdiff::components.diff', ['diffHtml' => $diffHtml]);
    }
}
