<?php


// Parse declrations from header file.
$ffi = FFI::cdef( 'typedef struct JSRuntime JSRuntime;
typedef struct JSContext JSContext;
typedef struct JSObject JSObject;
typedef struct JSClass JSClass;
typedef uint32_t JSClassID;
typedef uint32_t JSAtom;

typedef struct JSValueUnion {
    int32_t myInt;
} JSValueUnion;

typedef struct JSValue {
    struct {
		int32_t myInt;
	} u;
    int64_t tag;
} JSValue;

JSRuntime *JS_NewRuntime(void);
JSContext *JS_NewContext(JSRuntime *rt);
JSValue JS_Eval(JSContext *ctx, const char *input, size_t input_len, const char *filename, int eval_flags);
', './ffi/libquickjs.so' );

$runtime = $ffi->JS_NewRuntime();
$context = $ffi->JS_NewContext( $runtime );

$result = $ffi->JS_Eval( $context, '1 + 1', 5, 'test.js', 0 );

var_dump( $result );
