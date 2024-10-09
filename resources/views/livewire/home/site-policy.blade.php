<main class="grow">
    <section class="py-8 bg-white lg:py-24 dark:bg-gray-900">
        <div class="max-w-4xl px-4 mx-auto lg:px-4 format dark:format-invert text-gray-600 dark:text-gray-400">
            {{--{{dd(cache('config.policy'))}}--}}
            @if ($policyId == 'terms')
                <h1 class="mb-6 text-3xl font-bold text-gray-900 lg:text-4xl dark:text-white">이용약관</h1>
                {!! cache('config.policy')->policy->terms !!}
            @elseif ($policyId == 'policy')
                <h1 class="mb-6 text-3xl font-bold text-gray-900 lg:text-4xl dark:text-white">개인정보처리방침</h1>
                {!! cache('config.policy')->policy->policy !!}
            @endif
        </div>
    </section>
</main>

