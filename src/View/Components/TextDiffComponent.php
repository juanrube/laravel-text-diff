<?php

namespace Juanrube\TextDiff\View\Components;

use Illuminate\View\Component;
use Juanrube\TextDiff\Facades\TextDiff;

class TextDiffComponent extends Component
{
    public $oldText;
    public $newText;

    /**
     * Create a new component instance.
     * 
     * @param string $oldText The original text.
     * @param string $newText The modified text..
     */
    public function __construct($oldText, $newText)
    {
        $this->oldText = $oldText;
        $this->newText = $newText;
    }

    public function render()
    {
        $diffHtml = TextDiff::generateDiff($this->oldText, $this->newText);

        return view('textdiff::components.text-diff', [
            'diffHtml' => $diffHtml,
        ]);
    }
}
