public function up()
{
    Schema::create('transaction_disputes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('transaction_id')->constrained();
        $table->string('status')->default('pending');
        $table->text('description');
        $table->text('admin_response')->nullable();
        $table->timestamps();
    });
}
