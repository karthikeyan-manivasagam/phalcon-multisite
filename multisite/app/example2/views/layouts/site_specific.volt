<div id="page-wrap">
      <div id="page">
      {{ partial('components/common/content/header') }}
      {{ partial('pages/'~ router.getControllerName() ~'/' ~  dispatcher.getActionName()) }}  
      {{ partial('components/common/content/footer') }}
      </div>
    </div>