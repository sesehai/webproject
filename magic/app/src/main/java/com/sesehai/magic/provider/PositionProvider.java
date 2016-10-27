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

import com.sesehai.magic.database.DatabaseHelper;

public class PositionProvider extends ContentProvider {

    /**
     * Database specific constant declarations
     */
    private SQLiteDatabase db;

    public static  String AUTHORITY = "com.sesehai.magic.db.magic.position";
    public static final String TABLE_NAME= "position";
    public static final Uri URI = Uri.parse("content://" + AUTHORITY + "/" + TABLE_NAME);
    private static final int MATCH_CODE = 1;
    public static final String COL_ID= "_id";
    public static final String COL_HOUSE_ID = "house_id";
    public static final String COL_NAME= "name";
    public static final String COL_DESC= "desc";
    public static final String COL_CTIME= "ctime";
    public static final String COL_UTIME= "utime";
    public static final UriMatcher URI_MATCHER = new UriMatcher(UriMatcher.NO_MATCH);

    static {
        URI_MATCHER.addURI(AUTHORITY, TABLE_NAME, MATCH_CODE);
    }

    public PositionProvider() {
    }

    @Override
    public boolean onCreate() {
        // TODO: Implement this to initialize your content provider on startup.
        DatabaseHelper helper = new DatabaseHelper(this.getContext());
        /**
         * Create a write able database which will trigger its creation if it
         * doesn't already exist.
         */
        db = helper.getWritableDatabase();
        return (db == null) ? false : true;
    }

    @Override
    public int delete(Uri uri, String selection, String[] selectionArgs) {
        int count= 0;
        try{

            int match = URI_MATCHER.match(uri);
            switch (match) {
                case MATCH_CODE:
                    count = db.delete(TABLE_NAME, selection, selectionArgs);
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
            switch (match) {
                case MATCH_CODE:
                    rowId = db.insert(TABLE_NAME , null, values);
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
    public Cursor query(Uri uri, String[] projection, String selection,
                        String[] selectionArgs, String sortOrder) {
        Cursor cursor = null;
        try{

            int match = URI_MATCHER.match(uri);
            switch (match) {
                case MATCH_CODE:
                    cursor = db.query(TABLE_NAME, null, selection, selectionArgs,null, null, sortOrder);
                    cursor.setNotificationUri(getContext().getContentResolver(), uri);
                    break;
                default:
                    throw new UnsupportedOperationException("Unknown or unsupported URL: " + uri.toString());
            }
        }catch(Exception e) {

            e.printStackTrace();
        }
        return cursor;
    }

    @Override
    public int update(Uri uri, ContentValues values, String selection,
                      String[] selectionArgs) {
        int count= 0;
        try{

            int match = URI_MATCHER.match(uri);
            switch (match) {
                case MATCH_CODE:
                    count = db.update(TABLE_NAME, values, selection, selectionArgs);
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