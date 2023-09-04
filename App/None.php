<?php
#auto-name
namespace App;

use Mmb\Compile\Attributes\OnCallbackPattern;
use Mmb\Compile\Attributes\OnCallbackSettings;
use Mmb\Controller\Controller;
use Mmb\Controller\QueryControl\CallbackControl;
use Mmb\Controller\QueryControl\QueryBooter;

#[OnCallbackSettings(handler:'pv, inline')]
class None extends Controller
{

    use CallbackControl;
    public function bootCallback(QueryBooter $booter)
    {
        #region Compiler Callback
            $booter->pattern("none")->invoke('none');
        #endregion
        #region Compiler Inline
            $booter->pattern("none")->invoke('none');
        #endregion
    }

    #[OnCallbackPattern('none')]
    public function none()
    {
        answer();
    }

}
