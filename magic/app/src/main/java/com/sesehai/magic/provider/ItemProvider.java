package com.sesehai.magic.provider;

import android.content.ContentProvider;
import android.content.ContentUris;
import android.content.ContentValues;
import android.content.Context;
import android.content.UriMatcher;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.net.Uri;

public class ItemProvider extends ContentProvider {


    class DBHelper extends SQLiteOpenHelper {

        private static final String DB_MAGIC = "magic.db";
        private static final int VERSION = 1;

        public DBHelper(Context context) {
            super(context, DB_MAGIC, null, VERSION);
        }

        /**
         * 第一次运行的时候创建
         */
        @Override
        public void onCreate(SQLiteDatabase db) {
            db.execSQL("CREATE TABLE IF NOT EXISTS " + TABLE_ITEM + " ("+COL_ID+" integer primary key autoincrement, "+COL_POSITION_ID+" text, "+COL_NAME+" text, "+COL_DESC+" text, "+COL_CTIME+" text, "+COL_UTIME+" text)");
        }

        /**
         * 更新的时候
         */
        @Override
        public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
            db.execSQL("DROP TABLE IF EXISTS " + TABLE_ITEM);
            onCreate(db);
        }
    }

    /**
     * Database specific constant declarations
     */
    private SQLiteDatabase db;

    public static  String AUTHORITY = "com.sesehai.magic.db.magic";
    private static final String TABLE_ITEM= "item";
    public static final Uri URI = Uri.parse("content://" + AUTHORITY + "/" + TABLE_ITEM);
    private static final int MATCH_CODE = 1;
    public static final String COL_ID= "_id";
    public static final String COL_POSITION_ID = "position_id";
    public static final String COL_NAME= "name";
    private static final String COL_DESC= "desc";
    private static final String COL_CTIME= "ctime";
    private static final String COL_UTIME= "utime";
    private static final UriMatcher URI_MATCHER = new UriMatcher(UriMatcher.NO_MATCH);

    static {
        URI_MATCHER.addURI(AUTHORITY, TABLE_ITEM, MATCH_CODE);
    }
    DBHelper helper= null;

    public ItemProvider() {
    }

    @Override
    public int delete(Uri uri, String selection, String[] selectionArgs) {
        int count= 0;
        try{

            int match = URI_MATCHER.match(uri);
            SQLiteDatabase db = helper.getWritableDatabase();
            switch (match) {
                case MATCH_CODE:
                    count = db.delete(TABLE_ITEM, selection, selectionArgs);
                    break;
                default:
                    throw new UnsupportedOperationException("Unknown or unsupported URL: " + uri.toString());
            }
            this.getContext().getContentResolver().notifyChange(uri, null);
        }catch(Exception e) {

            e.printStackTrace();
        }
        return count;
    }

    @Override
    public String getType(Uri uri) {
        // TODO: Implement this to handle requests for the MIME type of the data
        // at the given URI.
        throw new UnsupportedOperationException("Not yet implemented");
    }

    @Override
    public Uri insert(Uri uri, ContentValues values) {
        // TODO: Implement this to handle requests to insert a new row.

        long rowId;
        Uri newUri = null;
        try{

            int match = URI_MATCHER.match(uri);
            SQLiteDatabase db = helper.getWritableDatabase();
            switch (match) {
                case MATCH_CODE:
                    rowId = db.insert(TABLE_ITEM , null, values);
                    if (rowId > 0) {
                        newUri = ContentUris.withAppendedId(URI, rowId);
                    }
                    break;

                default:
                    throw new UnsupportedOperationException("Unknown or unsupported URL: " + uri.toString());

            }

            if (newUri != null) {
                getContext().getContentResolver().notifyChange(uri, null);
            }
        }catch(Exception e) {

            e.printStackTrace();
        }
        return newUri;
    }

    @Override
    public boolean onCreate() {
        // TODO: Implement this to initialize your content provider on startup.
        helper= new DBHelper(this.getContext());
        /**
         * Create a write able database which will trigger its creation if it
         * doesn't already exist.
         */
        db = helper.getWritableDatabase();
        return (db == null) ? false : true;
    }

    @Override
    public Cursor query(Uri uri, String[] projection, String selection,
                        String[] selectionArgs, String sortOrder) {
        // TODO: Implement this to handle query requests from clients.
        throw new UnsupportedOperationException("Not yet implemented");
    }

    @Override
    public int update(Uri uri, ContentValues values, String selection,
                      String[] selectionArgs) {
        int count= 0;
        try{

            int match = URI_MATCHER.match(uri);
            SQLiteDatabase db = helper.getWritableDatabase();

            switch (match) {
                case MATCH_CODE:
                    count = db.update(TABLE_ITEM, values, selection, selectionArgs);
                    break;
                default:
                    throw new UnsupportedOperationException("Unknown or unsupported URL: " + uri.toString());
            }

            this.getContext().getContentResolver().notifyChange(uri, null);
        }catch(Exception e) {

            e.printStackTrace();
        }
        return count;
    }
}
