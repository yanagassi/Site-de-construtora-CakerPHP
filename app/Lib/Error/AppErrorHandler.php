<?php
class AppErrorHandler extends ErrorHandler {

    /**
     * List of Cake Exception classes to record to specified log level.
     *
     * @var array
     */
    protected static $_exceptionClasses = array(
        'MissingControllerException' => '404',
        'MissingActionException' => '404',
        'PrivateActionException' => '404',
        'NotFoundException' => '404'
    );

    public static function handleException($exception) {
        $config = Configure::read('Exception');
        self::_log($exception, $config);

        $renderer = isset($config['renderer']) ? $config['renderer'] : 'ExceptionRenderer';
        if ($renderer !== 'ExceptionRenderer') {
            list($plugin, $renderer) = pluginSplit($renderer, true);
            App::uses($renderer, $plugin . 'Error');
        }
        try {
            $error = new $renderer($exception);
            $error->render();
        } catch (Exception $e) {
            set_error_handler(Configure::read('Error.handler')); // Should be using configured ErrorHandler
            Configure::write('Error.trace', false); // trace is useless here since it's internal
            $message = sprintf("[%s] %s\n%s", // Keeping same message format
                get_class($e),
                $e->getMessage(),
                $e->getTraceAsString()
            );

            self::$_bailExceptionRendering = true;
            trigger_error($message, E_USER_ERROR);
        }
    }

    /**
     * Generates a formatted error message
     *
     * @param Exception $exception Exception instance
     * @return string Formatted message
     */
    protected static function _getMessage($exception) {
        $message = '';
        if (php_sapi_name() !== 'cli') {
            $request = Router::getRequest();
            if ($request) {
                $message .= $request->here() . " Not Found" ." | IP Address: ". CakeRequest::clientIp();
            }
        }
        $message .= "\nStack Trace:\n" . $exception->getTraceAsString() . "\n";
        return $message;
    }

    /**
     * Handles exception logging
     *
     * @param Exception $exception The exception to render.
     * @param array $config An array of configuration for logging.
     * @return bool
     */
    protected static function _log($exception, $config) {
        if (!empty(self::$_exceptionClasses)) {
            foreach ((array)self::$_exceptionClasses as $class => $level) {
                if ($exception instanceof $class) {
                    return CakeLog::write($level, self::_getMessage($exception));
                }
            }
        }
        return parent::_log($exception, $config);
    }
}