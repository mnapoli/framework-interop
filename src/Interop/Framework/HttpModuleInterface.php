<?php
namespace Interop\Framework;

use Symfony\Component\HttpKernel\HttpKernelInterface;

interface HttpModuleInterface extends ModuleInterface
{
	/**
	 * You can return a StackPHP middleware if the module provides one.
	 *
	 * @param $app HttpKernelInterface The kernel your middleware will be wrapping.
	 * @return HttpKernelInterface|null
	 */
	public function getHttpMiddleware(HttpKernelInterface $app);
}
