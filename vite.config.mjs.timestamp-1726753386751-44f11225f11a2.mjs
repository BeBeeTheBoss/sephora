// vite.config.mjs
import { defineConfig } from "file:///C:/Users/Lenovo%20(E14)/Herd/sephora/node_modules/vite/dist/node/index.js";
import vue from "file:///C:/Users/Lenovo%20(E14)/Herd/sephora/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import laravel from "file:///C:/Users/Lenovo%20(E14)/Herd/sephora/node_modules/laravel-vite-plugin/dist/index.js";
import { resolve } from "path";
var __vite_injected_original_dirname = "C:\\Users\\Lenovo (E14)\\Herd\\sephora";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.js", "resources/css/app.css"],
      refresh: true
    }),
    vue()
  ],
  resolve: {
    alias: {
      "@": resolve(__vite_injected_original_dirname, "resources/js")
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcubWpzIl0sCiAgInNvdXJjZXNDb250ZW50IjogWyJjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZGlybmFtZSA9IFwiQzpcXFxcVXNlcnNcXFxcTGVub3ZvIChFMTQpXFxcXEhlcmRcXFxcc2VwaG9yYVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcVXNlcnNcXFxcTGVub3ZvIChFMTQpXFxcXEhlcmRcXFxcc2VwaG9yYVxcXFx2aXRlLmNvbmZpZy5tanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L1VzZXJzL0xlbm92byUyMChFMTQpL0hlcmQvc2VwaG9yYS92aXRlLmNvbmZpZy5tanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHsgcmVzb2x2ZSB9IGZyb20gJ3BhdGgnO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogWydyZXNvdXJjZXMvanMvYXBwLmpzJywgJ3Jlc291cmNlcy9jc3MvYXBwLmNzcyddLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgICAgIHZ1ZSgpLFxuICAgIF0sXG4gICAgcmVzb2x2ZToge1xuICAgICAgICBhbGlhczoge1xuICAgICAgICAgICAgJ0AnOiByZXNvbHZlKF9fZGlybmFtZSwgJ3Jlc291cmNlcy9qcycpLFxuICAgICAgICB9LFxuICAgIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBc1MsU0FBUyxvQkFBb0I7QUFDblUsT0FBTyxTQUFTO0FBQ2hCLE9BQU8sYUFBYTtBQUNwQixTQUFTLGVBQWU7QUFIeEIsSUFBTSxtQ0FBbUM7QUFLekMsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTyxDQUFDLHVCQUF1Qix1QkFBdUI7QUFBQSxNQUN0RCxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsSUFDRCxJQUFJO0FBQUEsRUFDUjtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ0wsT0FBTztBQUFBLE1BQ0gsS0FBSyxRQUFRLGtDQUFXLGNBQWM7QUFBQSxJQUMxQztBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
