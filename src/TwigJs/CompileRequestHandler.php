<?php

/*
 * Copyright 2011 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace TwigJs;

use Twig\Environment;
use Twig\Source;

class CompileRequestHandler
{
    private $env;
    private $compiler;

    public function __construct(Environment $env, JsCompiler $compiler)
    {
        $this->env = $env;
        $this->compiler = $compiler;
    }

    /**
     * @param CompileRequest $request
     * @return string
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function process(CompileRequest $request)
    {
        $curCompiler = null;
        if (method_exists($this->env, 'getCompiler')) {
            $curCompiler = $this->env->getCompiler();
        } else {
            $rp = new \ReflectionProperty($this->env, 'compiler');
            $rp->setAccessible(true);
            $curCompiler = $rp->getValue($this->env);
        }
        $this->env->setCompiler($this->compiler);
        $this->compiler->setDefines($request->getDefines());
        try {
            $source = $request->getSource();
            if (is_string($source)) {
                $source = new Source($source, $request->getName());
            }
            $compiled = $this->env->compileSource($source);
            if ($curCompiler) {
                $this->env->setCompiler($curCompiler);
            }

            return $compiled;
        } catch (\Exception $ex) {
            if ($curCompiler) {
                $this->env->setCompiler($curCompiler);
            }

            throw $ex;
        }
    }
}
